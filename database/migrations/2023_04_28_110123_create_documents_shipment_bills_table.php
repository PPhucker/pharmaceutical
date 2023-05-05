<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsShipmentBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_shipment_bills', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('created_by_id')
                ->nullable()
                ->comment('Пользователь, создавший документ');
            $table->foreign('created_by_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedBigInteger('updated_by_id')
                ->nullable()
                ->comment('Пользователь, изменивший документ');
            $table->foreign('updated_by_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedBigInteger('approved_by_id')
                ->nullable()
                ->comment('Пользователь, согласовавший документ');
            $table->foreign('approved_by_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedBigInteger('packing_list_id')
                ->comment('ID Товарной накладной');
            $table->foreign('packing_list_id')
                ->references('id')
                ->on('documents_shipment_packing_lists')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('number', 10)
                ->comment('Номер');

            $table->date('date')
                ->comment('Дата выставления');

            $table->boolean('approved')
                ->nullable()
                ->comment('Согласовано');

            $table->text('comment')
                ->nullable()
                ->comment('Комментарий');

            $table->string('filename')
                ->nullable()
                ->comment('Прикрепленный файл');

            $table->dateTime('approved_at')
                ->nullable()
                ->comment('Дата и время согласования');

            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement(
            "ALTER TABLE `documents_shipment_bills` COMMENT 'Счет-фактуры'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_shipment_bills');
    }
}
