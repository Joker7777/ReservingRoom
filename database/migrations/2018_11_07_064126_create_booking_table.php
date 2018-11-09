<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booklist', function (Blueprint $table) {
            // $table->charset = 'utf8';
            $table->increments('id');
            $table->text('name')->comment('バンド名など');
            $table->date('date')->comment('予約日');
            $table->integer('frame')->comment('予約時限');
            $table->integer('every_week_id')->comment('毎週予約ID')->default(null);
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
        Schema::dropIfExists('booking');
    }
}
