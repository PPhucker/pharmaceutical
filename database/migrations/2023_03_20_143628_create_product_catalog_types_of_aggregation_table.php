<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCatalogTypesOfAggregationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_catalog_types_of_aggregation', static function (Blueprint $table) {
            $table->string('aggregation_type', 10)
                ->comment('Тип агрегации');
            $table->foreign('aggregation_type')
                ->references('code')
                ->on('classifier_types_of_aggregation')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('product_catalog_id')
                ->comment('Продукт');
            $table->foreign('product_catalog_id')
                ->references('id')
                ->on('product_catalog')
                ->cascadeOnDelete();
            $table->integer('product_quantity')
                ->comment('Кол-во продукции в типе агрегации');
        });

        DB::statement(
            "ALTER TABLE `product_catalog_types_of_aggregation` COMMENT 'Агрегация продукции из каталога'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_catalog_types_of_aggregation');
    }
}
