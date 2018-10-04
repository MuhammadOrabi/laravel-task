<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{

    public function up()
    {
        Schema::create('permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('model');
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('permissions');
    }
}
