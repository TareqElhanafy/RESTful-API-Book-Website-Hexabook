<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaidbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paidbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('writer_name');
            $table->text('description');
            $table->string('image');
            $table->string('available');
            $table->integer('seller_id');
            $table->integer('price');
            $table->integer('quantity');
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
        Schema::dropIfExists('paidbooks');
    }
}
