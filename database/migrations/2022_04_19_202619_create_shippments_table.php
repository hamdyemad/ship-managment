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
        Schema::create('shippments', function (Blueprint $table) {
            $table->id();
            // $table->string('address_line');
            $table->string('shippment_type');
            $table->string('business_referance');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('address');
            $table->string('allow_open');
            $table->string('price');
            $table->string('package_details')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->string('barcode');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('area_id')->constrained();
            $table->date('on_hold')->nullable();
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
        Schema::dropIfExists('shippments');
    }
};
