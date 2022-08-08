<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortalUserModulePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_user_module_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('module_slug');
            $table->string('role_slug');
            $table->boolean('can_add');
            $table->boolean('can_edit');
            $table->boolean('can_view');
            $table->boolean('can_delete');
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
        Schema::dropIfExists('portal_user_module_permissions');
    }
}
