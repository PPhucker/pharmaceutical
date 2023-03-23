<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierInternationalNamesOfEndProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_international_names_of_end_products', static function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)
                ->comment('Международное непатентованное название');
        });

        DB::statement(
            "ALTER TABLE `classifier_international_names_of_end_products`
                    COMMENT 'Классификатор международных непатентованных названий готовой продукции'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_international_names_of_end_products');
    }
}
