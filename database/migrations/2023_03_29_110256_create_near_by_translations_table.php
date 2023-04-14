<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNearByTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('near_by_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('near_id')->constrained('near_bies')->onDelete('cascade');
            $table->string('button_title', 20);
            $table->string('button_url', 255 );
            $table->string('language', 10)->index();
            $table->unique(['near_id', 'language']);
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
        Schema::dropIfExists('near_by_translations');
    }
}
