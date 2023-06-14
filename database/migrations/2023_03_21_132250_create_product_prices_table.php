<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->default(1)
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->unsignedBigInteger('product_catalog_id')
                ->comment('Продукт из каталога');
            $table->foreign('product_catalog_id')
                ->references('id')
                ->on('product_catalog')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('organization_id')
                ->comment('Организация');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnDelete();
            $table->float('retail_price')
                ->comment('Розничная цена');
            $table->float('trade_price')
                ->nullable()
                ->comment('Оптовая цена');
            $table->float('nds')
                ->default(0.1)
                ->comment('НДС');
            $table->integer('trade_quantity')
                ->nullable()
                ->comment('Кол-во продукции для оптовой цены');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_prices');
    }
}
