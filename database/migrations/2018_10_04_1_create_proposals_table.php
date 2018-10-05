<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{

    public function up()
    {
        Schema::create('proposals', function(Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('approval_from');
            $table->string('client_source');
            $table->string('client_name');
            $table->string('value');
            $table->string('code');
            $table->date('due');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('proposals');
    }
}
