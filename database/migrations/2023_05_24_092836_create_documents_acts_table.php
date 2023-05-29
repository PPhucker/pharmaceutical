<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_acts', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('number', 10)
                ->comment('Номер');
            $table->date('date')
                ->comment('Дата');

            $table->unsignedBigInteger('organization_id')
                ->comment('Исполнитель');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedBigInteger('contractor_id')
                ->comment('Заказчик');
            $table->foreign('contractor_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('filename')
                ->nullable()
                ->comment('Прикрепленный файл');

            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement(
            "ALTER TABLE `documents_acts` COMMENT 'Акты'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_acts');
    }
}
