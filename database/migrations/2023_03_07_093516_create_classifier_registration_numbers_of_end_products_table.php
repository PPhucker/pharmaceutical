<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierRegistrationNumbersOfEndProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_registration_numbers_of_end_products', static function (Blueprint $table) {
            $table->id();
            $table->string('number', 30)
                ->comment('Регистрационный номер');
        });

        DB::statement(
            "ALTER TABLE `classifier_registration_numbers_of_end_products`
                    COMMENT 'Классификатор регистрационных номеров готовой продукции'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_registration_numbers_of_end_products');
    }
}
