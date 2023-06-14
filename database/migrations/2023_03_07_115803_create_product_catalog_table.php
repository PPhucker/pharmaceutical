<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_catalog', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->default(1)
                ->nullable()
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->unsignedBigInteger('product_id')
                ->comment('Продукт');
            $table->foreign('product_id')
                ->references('id')
                ->on('classifier_end_products')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('organization_id')
                ->comment('Организация');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('place_of_business_id')
                ->comment('Место деятельности');
            $table->foreign('place_of_business_id')
                ->references('id')
                ->on('organizations_places_of_business')
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `product_catalog` COMMENT 'Каталог готовой продукции для продажи'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_catalog');
    }
}
