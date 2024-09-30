<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_prices', function (Blueprint $table) {
            // Удаление столбцов trade_price и trade_quantity
            $table->dropColumn(['trade_price', 'trade_quantity']);
            // Переименование столбца retail_price в price
            $table->renameColumn('retail_price', 'price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_prices', function (Blueprint $table) {
            // Добавление столбцов trade_price и trade_quantity обратно
            $table->decimal('trade_price', 8, 2)->nullable();
            $table->integer('trade_quantity')->nullable();
            // Переименование столбца price обратно в retail_price
            $table->renameColumn('price', 'retail_price');
        });
    }
}
