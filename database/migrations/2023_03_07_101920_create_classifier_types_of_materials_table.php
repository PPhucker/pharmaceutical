<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierTypesOfMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_types_of_materials', static function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)
                ->comment('Тип материалов');
        });

        DB::statement(
            "ALTER TABLE `classifier_types_of_materials`
                COMMENT 'Классификатор типов комплектующих'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_types_of_materials');
    }
}
