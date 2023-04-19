<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsInvoicesForPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_invoices_for_payment', static function (Blueprint $table) {
            $table->id();

            //Пользовавель
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->comment('ID Пользователя');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            //Поставщик
            $table->unsignedBigInteger('organization_id')
                ->comment('ID Организации');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            //Адрес отгрузки
            $table->unsignedBigInteger('organization_place_id')
                ->comment('ID Адреса Отгрузки');
            $table->foreign('organization_place_id')
                ->references('id')
                ->on('organizations_places_of_business')
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();

            //Банковские реквизиты поставщика
            $table->unsignedBigInteger('organization_bank_id')
                ->nullable()
                ->comment('ID Банковских реквизитов организации');
            $table->foreign('organization_bank_id')
                ->references('id')
                ->on('organizations_bank_account_details')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            //Контрагент
            $table->unsignedBigInteger('contractor_id')
                ->comment('ID Контрагента');
            $table->foreign('contractor_id')
                ->references('id')
                ->on('contractors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            //Адрес доставки
            $table->unsignedBigInteger('contractor_place_id')
                ->comment('ID Адреса Доставки');
            $table->foreign('contractor_place_id')
                ->references('id')
                ->on('contractors_places_of_business')
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();

            //Банковские реквизиты контрагента
            $table->unsignedBigInteger('contractor_bank_id')
                ->nullable()
                ->comment('ID Банковских Реквизитов Контрагента');
            $table->foreign('contractor_bank_id')
                ->references('id')
                ->on('contractors_bank_account_details')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('number', 10)
                ->comment('Номер');

            $table->date('date')
                ->comment('Дата выставления');

            $table->string('director', 60)
                ->nullable()
                ->comment('Руководитель');

            $table->string('bookkeeper', 60)
                ->nullable()
                ->comment('Главный бухгалтер');

            $table->string('filename')
                ->nullable()
                ->comment('Прикрепленный файл');

            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `documents_invoices_for_payment` COMMENT 'Счета на оплату'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_invoices_for_payment');
    }
}
