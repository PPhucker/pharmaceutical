<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndProductsMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('end_products_materials', static function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
                ->default(1)
                ->nullable()
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->unsignedBigInteger('end_product_id')
                ->comment('Продукт');
            $table->foreign('end_product_id')
                ->references('id')
                ->on('classifier_end_products')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('material_id')
                ->comment('Комплектующее');
            $table->foreign('material_id')
                ->references('id')
                ->on('classifier_materials')
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `end_products_materials` COMMENT 'Комплектующие готовой продукции'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('end_products_materials');
    }
}
