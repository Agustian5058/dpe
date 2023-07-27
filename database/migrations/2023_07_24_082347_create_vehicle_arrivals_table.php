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
            $table->id();
            $table->string('arrival_id')->unique();
            $table->date('arrival_date');
            $table->string('arrival_vehicle');
            $table->foreign('arrival_vehicle')->references('vehicle_id')->on('vehicles')->onDelete('cascade');
            $table->timestamps();
            $table->integer("created_by")->nullable();
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
            $table->softDeletes();
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
