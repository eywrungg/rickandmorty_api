<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('character_id'); // Rick & Morty character id
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->unique(['user_id','character_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};
