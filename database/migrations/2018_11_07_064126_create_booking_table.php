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
            $table->increments('id');
            $table->text('name')->comment('バンド名など');
            $table->date('one_time_date')->nullable()->comment('一回予約の予約日');
            $table->date('every_week_start_date')->nullable()->comment('毎週予約の開始日');
            $table->date('every_week_end_date')->nullable()->comment('毎週予約の終了日');
            $table->integer('every_week_day')->nullable()->comment('毎週予約の予約曜日');
            $table->integer('frame')->comment('予約時限');
            $table->integer('every_week_id')->nullable()->comment('毎週予約ID')->default(null);
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
