<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_materials', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')
                ->nullable()
                ->comment('Тип комплектующего');
            $table->foreign('type_id')
                ->references('id')
                ->on('classifier_types_of_materials')
                ->nullOnDelete();
            $table->string('okei_code', 10)
                ->nullable()
                ->comment('Код ОКЕИ');
            $table->foreign('okei_code')
                ->references('code')
                ->on('classifier_okei')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('name', 150)
                ->comment('Название комплектующего');
        });

        DB::statement(
            "ALTER TABLE `classifier_materials` COMMENT 'Классификатор комплектующих'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_materials');
    }
}
