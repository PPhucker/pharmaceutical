<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWholesalePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_wholesale_prices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                ->default(1)
                ->comment('ID Пользователя');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('product_catalog_id')
                ->comment('ID Продукта из каталога готовой продукции');
            $table->foreign('product_catalog_id')
                ->references('id')
                ->on('product_catalog')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedBigInteger('organization_id')
                ->comment('ID организации');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->float('wholesale_price')
                ->comment('Оптовая цена');

            $table->integer('wholesale_quantity')
                ->comment('Оптовое кол-во');

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
        Schema::dropIfExists('product_wholesale_prices');
    }
}
