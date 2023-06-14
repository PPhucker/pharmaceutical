<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCatalogMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_catalog_materials', static function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
                ->default(1)
                ->nullable()
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->unsignedBigInteger('product_catalog_id')
                ->comment('Продукт');
            $table->foreign('product_catalog_id')
                ->references('id')
                ->on('product_catalog')
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
            "ALTER TABLE `product_catalog_materials` COMMENT 'Комплектующие продукции из каталога'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_catalog_materials');
    }
}
