<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Миграция для региональных надбавок готовой продукции.
 */
class CreateProductRegionalAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('product_regional_allowances', static function (Blueprint $table) {
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

            $table->unsignedBigInteger('region_id')
                ->comment('ID Региона');
            $table->foreign('region_id')
                ->references('id')
                ->on('classifier_regions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->float('allowance')
                ->comment('Размер надбавки');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('product_regional_allowances');
    }
}
