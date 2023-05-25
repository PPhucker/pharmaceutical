<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsActsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_acts_services', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->unsignedBigInteger('service_id')
                ->comment('Работа, услуга');
            $table->foreign('service_id')
                ->references('id')
                ->on('classifier_services')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('qauntity')
                ->comment('Кол-во');
            $table->float('price')
                ->comment('Цена');
            $table->float('nds')
                ->comment('НДС');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement(
            "ALTER TABLE `documents_acts_services` COMMENT 'Услуги актов'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_acts_services');
    }
}
