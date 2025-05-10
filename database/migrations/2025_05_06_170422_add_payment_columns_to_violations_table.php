<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentColumnsToViolationsTable extends Migration
{
    public function up()
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->string('payment_status')->default('Unpaid'); // Paid/Unpaid
            $table->string('payment_method')->nullable(); // Online/Offline
        });
    }

    public function down()
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_method']);
        });
    }
}
