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

        Schema::create('damage_repair_shop', function (Blueprint $table) {
            $table->bigInteger('damage_id')->unsigned()->index();
            $table->bigInteger('repair_shops_id')->unsigned()->index();

            $table->foreign('repair_shops_id')
                ->references('id')
                ->on('repair_shops')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('damage_id')
                ->references('id')
                ->on('damages')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('damage_repair_shop');
    }
};
