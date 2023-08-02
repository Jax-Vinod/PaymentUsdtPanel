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
        Schema::create('usdt_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->string('amount');
            $table->integer('bank_id')->nullable();
            $table->string('dest_bank_detail')->nullable();
            $table->string('document')->nullable();
            $table->char('status', 255)->default('created');
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
        Schema::dropIfExists('usdt_purchases');
    }
};
