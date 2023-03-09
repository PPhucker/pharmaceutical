<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierOkpd2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_okpd2', static function (Blueprint $table) {
            $table->string('code', 20)
                ->primary()
                ->comment('Код');
            $table->string('name', 150)
                ->comment('Название');
        });

        DB::statement(
            "ALTER TABLE `classifier_okpd2`
                    COMMENT 'Общероссийский классификатор продукции по видам экономической деятельности'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_okpd2');
    }
}
