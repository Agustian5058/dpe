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
            $table->string('consignee');
            $table->string('goods_type');
            $table->string('feet');
            $table->double('qty');
            $table->double('size');
            $table->string('unit');
            $table->string('price');
            $table->string('destination');
            $table->double('debit');
            $table->double('credit');
            $table->string('trasaction_vehicle_arrival');
            $table->string('trasaction_customer');
            $table->string('trasaction_user');
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
