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
            $table->id();
            $table->string('transaction_id')->unique();
            $table->date('transaction_date');
            $table->string('transaction_container_number')->nullable();
            $table->string('goods_type')->nullable();
            $table->double('feet')->nullable();
            $table->double('qty')->nullable();
            $table->string('note');
            $table->double('price');
            $table->string('transaction_debit_credit');
            $table->string('transaction_transaction_type');
            $table->string('transaction_vehicle_arrival');
            $table->string('transaction_customer');
            $table->foreign('transaction_transaction_type')->references('transaction_name')->on('transaction_types')->onDelete('cascade');
            $table->foreign('transaction_vehicle_arrival')->references('arrival_id')->on('vehicle_arrivals')->onDelete('cascade');
            $table->foreign('transaction_customer')->references('customer_id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
};
