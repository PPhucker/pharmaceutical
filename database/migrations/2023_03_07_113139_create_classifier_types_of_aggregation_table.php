<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierTypesOfAggregationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_types_of_aggregation', static function (Blueprint $table) {
            $table->string('code', 10)
                ->primary()
                ->comment('Код типа');
            $table->string('name', 20)
                ->nullable()
                ->comment('Название типа');
        });

        DB::statement(
            "ALTER TABLE `classifier_types_of_aggregation` COMMENT 'Классификатор типов агрегации'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_types_of_aggregation');
    }
}
