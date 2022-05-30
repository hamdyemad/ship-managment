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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained();
            // $table->foreignId('shippment_id')->constrained();
            $table->foreignId('shippment_id')->nullable()->comment('اذا كانت القيمة فارغة الشحنة pickup');
            $table->foreignId('pickup_id')->nullable()->comment('اذا كانت القيمة فارغة الشحنة shippment');
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
        Schema::dropIfExists('deliveries');
    }
};
