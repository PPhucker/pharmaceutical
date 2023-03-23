<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierTypesOfEndProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_types_of_end_products', static function (Blueprint $table) {
            $table->id();
            $table->char('color', 7)
                ->nullable()
                ->default('#ffffff')
                ->comment('Цвет типа');
            $table->string('name', 60)
                ->comment('Тип готовой продукции');
        });

        DB::statement(
            "ALTER TABLE `classifier_types_of_end_products` comment 'Классификатор типов готовой продукции'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_types_of_end_products');
    }
}
