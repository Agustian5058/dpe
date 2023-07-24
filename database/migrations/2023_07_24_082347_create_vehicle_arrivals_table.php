<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_arrivals', function (Blueprint $table) {
            $table->string('arrival_id')->primary();
            $table->date('arrival_date');
            $table->string('arrival_vehicle');
            $table->string('consignee');
            $table->string('goods_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_arrivals');
    }
};
