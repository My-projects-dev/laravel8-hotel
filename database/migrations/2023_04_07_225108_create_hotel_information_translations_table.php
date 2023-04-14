<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelInformationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_information_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('info_id')->constrained('hotel_information')->onDelete('cascade');
            $table->string('title',100);
            $table->string('content',700);
            $table->string('language', 10)->index();
            $table->unique(['info_id', 'language']);
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
        Schema::dropIfExists('hotel_information_translations');
    }
}
