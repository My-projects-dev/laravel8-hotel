<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChefTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chef_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chef_id')->constrained('chefs')->onDelete('cascade');
            $table->string('full_name', 50);
            $table->string('position', 100);
            $table->string('about', 700);
            $table->string('language', 10)->index();
            $table->unique(['chef_id', 'language']);
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
        Schema::dropIfExists('chef_translations');
    }
}
