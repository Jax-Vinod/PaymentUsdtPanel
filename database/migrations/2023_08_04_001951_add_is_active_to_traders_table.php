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
        Schema::table('traders', function (Blueprint $table) {
            $table->boolean('is_active')->after('upi')->default(true);
            $table->string('sum')->after('upi')->default(0);
            $table->string('note')->after('upi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traders', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('sum');
            $table->dropColumn('is_active');
        });
    }
};
