<?php

use App\Models\Damage;
use App\Models\RepairShops;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('damages', function (Blueprint $table) {
            $table->dropColumn('repair_shops_id');
        });
        Schema::create('damage_repair_shop', function (Blueprint $table) {
            //$table->foreignIdFor(Damage::class)->constrained();
           // $table->foreignIdFor(RepairShops::class)->constrained();
            //$table->primary(['damage_id', 'repair_shops_id']);

            $table->unsignedInteger('damage_id');
            $table->unsignedInteger('repair_shops_id');


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

        Schema::table('damages', function (Blueprint $table) {
            $table->foreignId('repair_shops_id')->after('status')->nullable();
        });
    }
};
