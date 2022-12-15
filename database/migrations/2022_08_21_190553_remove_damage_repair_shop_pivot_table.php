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
        Schema::dropIfExists('damage_repair_shop');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('damage_repair_shop', function (Blueprint $table) {
            $table->unsignedInteger('damage_id');
            $table->unsignedInteger('repair_shops_id');
        });
    }
};
