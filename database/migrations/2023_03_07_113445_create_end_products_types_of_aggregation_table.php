<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndProductsTypesOfAggregationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('end_products_types_of_aggregation', static function (Blueprint $table) {
            $table->string('aggregation_type', 10)
                ->comment('Тип агрегации');
            $table->foreign('aggregation_type')
                ->references('code')
                ->on('classifier_types_of_aggregation')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('end_product_id')
                ->comment('Продукт');
            $table->foreign('end_product_id')
                ->references('id')
                ->on('classifier_end_products')
                ->cascadeOnDelete();
            $table->integer('product_quantity')
                ->comment('Кол-во продукции в типе агрегации');
        });

        DB::statement(
            "ALTER TABLE `end_products_types_of_aggregation` COMMENT 'Агрегация готовой продукции'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('end_products_types_of_aggregation');
    }
}
