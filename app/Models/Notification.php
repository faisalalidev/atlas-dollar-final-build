<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'ref_id',
        'wildcards',
        'sender',
        'receiver',
        'cascade_id',
        'read'
    ];

    public function identifier()
    {
        return $this->hasOne(NotificationIdentifier::class, 'slug', 'slug');
    }

    public static function createNotification($data)
    {
        if($data['sender'] == $data['receiver']) {
            return false;
        }

        return self::create([
            'slug' => $data['slug'],
            'ref_id' => $data['ref_id'],
            'wildcards' => implode(',', $data['wildcards']),
            'sender' => $data['sender'],
            'receiver' => $data['receiver'],
            'cascade_id' => $data['cascade_id']
        ]);
    }

    public function makeBody(&$notifications)
    {
        foreach ($notifications as $notification) {

            $notification_body_content = $notification->identifier->body;
            $notification_replacers = explode(',', $notification->identifier->replacer);
            $replacers = [];
            $wild_cards = explode(',', $notification->wildcards);

            foreach ($notification_replacers as $key => $notification_replacer) {

                $model = explode('/', $notification_replacer)[0];
                $namespaced_model = 'App\Models\\' . $model;
                $data = $namespaced_model::find($wild_cards[$key]);
                $replacers[$notification_replacer] = $data->{explode('/', $notification_replacer)[1]};

                $notification_body_content = str_replace($model, $data->{explode('/', $notification_replacer)[1]}, $notification_body_content);

            }

                $notification->body = $notification_body_content;
        }

        return $notifications->toArray();
    }
}
