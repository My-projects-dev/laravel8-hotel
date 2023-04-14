<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenity_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('amenity_id')->constrained('amenities')->onDelete('cascade');
            $table->string('title', 50);
            $table->string('language',10)->index();
            $table->unique(['amenity_id', 'language']);
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
        Schema::dropIfExists('amenity_translations');
    }
}
