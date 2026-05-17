<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
    {

		if(!Schema::hasTable('videos'))
        Schema::create('videos', function (Blueprint $table) {

			$table->increments('id');
			$table->string('type',100)->nullable();
			$table->string('provider',100)->nullable();
			$table->string('name',225)->nullable();
			$table->string('slug')->unique(); 
			$table->text('description')->nullable();
			$table->string('url',1000)->nullable();
			$table->boolean('autostart')->default('0');
			$table->string('access',100)->default('public');
			$table->boolean('active')->default('1');
			$table->integer('sorting')->nullable();
			$table->softDeletes();
			$table->timestamps();

        });

    }


    public function down()
    {
        Schema::dropIfExists('videos');
    }

}