<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteGTINColumnFromClassifierEndProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classifier_end_products', static function (Blueprint $table) {
            $table->dropColumn('GTIN');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classifier_end_products', function (Blueprint $table) {
            //
        });
    }
}
