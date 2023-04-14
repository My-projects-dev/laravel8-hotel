<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->double('price');
            $table->tinyInteger('adult');
            $table->tinyInteger('child')->nullable();
            $table->tinyInteger('infant')->nullable();
            $table->string('company_name',255)->nullable();
            $table->string('name',20);
            $table->string('surname',20);
            $table->string('email',100);
            $table->string('phone',30);
            $table->string('country',50);
            $table->string('city',50);
            $table->string('zip',20);
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
        Schema::dropIfExists('reservations');
    }
}
