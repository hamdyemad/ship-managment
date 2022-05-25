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
        Schema::create('scheduledrivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained();
            $table->date('from');
            $table->date('to');
            $table->String('total_cost');
            $table->String('total_delivery_commission');
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
        Schema::dropIfExists('scheduledrivers');
    }
};
