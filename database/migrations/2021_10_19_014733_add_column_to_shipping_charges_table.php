<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_charges', function (Blueprint $table) {
            $table->float('0-1000g')->after('city');
            $table->float('1001-10000g')->after('0-1000g');
            $table->float('10001-20000g')->after('1001-10000g');
            $table->float('20001-30000g')->after('10001-20000g');
            $table->float('30001-40000g')->after('20001-30000g');
            $table->float('40001-50000g')->after('30001-40000g');
            $table->float('above_50000g')->after('40001-50000g');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_charges', function (Blueprint $table) {
            //
        });
    }
}
