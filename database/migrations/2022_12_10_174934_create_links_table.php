<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('short_description');
            $table->string('image')->nullable();
            $table->string('link'); // this has to be unique
            $table->enum('type', ['article', 'video', 'post', 'tool']);
            $table->enum('difficulty', ['easy', 'medium', 'advanced']);
            $table->enum('status', [0, 1]);
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
        Schema::dropIfExists('links');
    }
};
