<?php

namespace App\Models;

use App\Libraries\WindWard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class InventoryImage extends Model
{
    use HasFactory;

    protected $fillable = ['inventory_id', 'image', 'image_name', 'image_type'];

    public function getImageFromApi($inventory_id)
    {
        $wind_ward_api = new WindWard();

        try {

            $inventory_image = $wind_ward_api->postDataRequest('get-inventory_images', '', ['PartUnique' => $inventory_id]);

            if (!isset($inventory_image->result)) {

                ApplicationSetting::sendErrorResponseToAdminEmails('get-inventory_images -----> Response is invalid. Response : ' . json_encode($inventory_image));
            }

            $inventory_image = $inventory_image->result[0];

            if ($inventory_image->Response == 'Success') {

                $this->where('inventory_id', $inventory_id)->delete();

                $inventory_images = $inventory_image->Results->Images;

                foreach ($inventory_images as $image) {

                    if (is_array($image->ImageBlob)) {

                        $file_name = isset($image->DataFileName) ? $image->DataFileName : '';

                        $image_name = time() . $file_name;

                        convertImageBlob($image_name, $image->ImageBlob);

                        $thumbnail = Image::make(public_path('files/' . $image_name))->resize(500, 500, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                        $thumbnail->save(public_path('files/thumb-' . $image_name));

                        $this->create([
                                'inventory_id' => $inventory_id,
                                'image' => $image_name,
                                'image_name' => $file_name,
                                'image_type' => $image->FileType,
                            ]
                        );
                    }
                }
            }
        } catch (\Exception $e) {

            CronErrorLog::create([
                'module_type' => 'inventory-images',
                'error' => $e->getMessage() . ' / Inventory-id = ' . $inventory_id
            ]);
        }
    }
}
