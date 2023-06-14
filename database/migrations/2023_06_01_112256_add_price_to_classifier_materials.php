<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToClassifierMaterials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classifier_materials', static function (Blueprint $table) {
            $table->float('price')
                ->nullable()
                ->comment('Цена с НДС');
            $table->float('nds')
                ->nullable()
                ->comment('НДС');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classifier_materials', static function (Blueprint $table) {
            //
        });
    }
}
