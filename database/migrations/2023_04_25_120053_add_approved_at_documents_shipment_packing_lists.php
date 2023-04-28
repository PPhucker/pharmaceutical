<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedAtDocumentsShipmentPackingLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents_shipment_packing_lists', static function (Blueprint $table) {
            $table->dateTime('approved_at')
                ->nullable()
                ->comment('Дата и время согласования');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents_shipment_packing_lists', static function (Blueprint $table) {
            //
        });
    }
}
