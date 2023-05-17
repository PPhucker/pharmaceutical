<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsShipmentWaybillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_shipment_waybills', static function (Blueprint $table) {
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

            $table->string('car_model', 20)
                ->nullable()->comment('Марка автомобиля');
            $table->string('state_car_number', 15)
                ->nullable()
                ->comment('Гос. № автомобиля');

            $table->string('driver', 40)
                ->nullable()
                ->comment('Водитель');

            $table->string('licence_card', 15)
                ->comment('Лицензионная карточка');

            $table->string('type_of_transportation', 15)
                ->comment('Вид перевозки');

            $table->string('trailer_1', 10)
                ->nullable()
                ->comment('Прицеп 1');
            $table->string('trailer_2', 10)
                ->nullable()
                ->comment('Прицеп 2');

            $table->string('state_trailer_1_number', 15)
                ->nullable()
                ->comment('Гос. № Прицеп 1');

            $table->string('state_trailer_2_number', 15)
                ->nullable()
                ->comment('Гос. № Прицеп 1');

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

            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `documents_shipment_waybills` COMMENT 'Товарно-транспортные накладные'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_shipment_waybills');
    }
}
