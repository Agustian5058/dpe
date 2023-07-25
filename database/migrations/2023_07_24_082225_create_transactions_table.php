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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('transaction_id')->primary();
            $table->date('transaction_date');
            $table->string('transaction_container_number');
            $table->string('consignee')->nullable();
            $table->string('goods_type')->nullable();
            $table->string('feet')->nullable();
            $table->double('qty')->nullable();
            $table->double('size')->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->nullable();
            $table->string('destination')->nullable();
            $table->string('description')->nullable();
            $table->double('debit')->nullable();
            $table->double('credit')->nullable();
            $table->string('trasaction_trasaction_type')->references('transaction_name')->on('transaction_type')->onDelete('cascade');;
            $table->string('trasaction_vehicle_arrival')->references('arrival_id')->on('vehicle_arrival')->onDelete('cascade');;
            $table->string('trasaction_customer')->references('customer_id')->on('customer')->onDelete('cascade');;
            $table->string('trasaction_user')->references('id')->on('sales')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
