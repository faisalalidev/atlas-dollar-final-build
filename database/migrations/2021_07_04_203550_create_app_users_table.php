<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('auth_type');
            $table->boolean('can_stream');
            $table->boolean('can_upload_music');
            $table->boolean('can_do_podcast');
            $table->string('avatar');
            $table->float('latitude' , 10 , 6)->nullable();
            $table->float('longitude' , 10 , 6)->nullable();
            $table->longText('bio')->nullable();
            $table->date('dob')->nullable();
            $table->string('cover_photo');
            $table->boolean('private_profile');
            $table->boolean('search_visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}
