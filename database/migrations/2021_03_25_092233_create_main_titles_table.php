<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_path');
            $table->string('line_title')->nullable();
            $table->longText('description')->nullable();
            // $table->string('line_two_title');
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
        Schema::dropIfExists('main_titles');
    }
}
