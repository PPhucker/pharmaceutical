<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGtinColumnToProductCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_catalog', static function (Blueprint $table) {
            $table->char('GTIN', 14)
                ->nullable()
                ->comment('Global Trade Item Number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_catalog', static function (Blueprint $table) {
            //
        });
    }
}
