<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierOkeiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_okei', static function (Blueprint $table) {
            $table->string('code', 10)
                ->primary()
                ->comment('Код');
            $table->string('unit', 20)
                ->comment('Единица измерения');
            $table->string('symbol', 10)
                ->comment('Сокращение единицы измерения');
        });

        DB::statement(
            "ALTER TABLE `classifier_okei`
                    COMMENT 'Общероссийский классификатор единиц измерения'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_okei');
    }
}
