<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // $table->string('type')->default('Car'); // Ô tô, Xe máy
            $table->string('brand')->nullable(); // Hãng xe
            $table->string('model')->nullable(); // Mẫu xe
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn(['type', 'brand', 'model', 'owner_id']);
        });
    }
}