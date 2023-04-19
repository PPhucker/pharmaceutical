<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsInvoicesForPaymentProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_invoices_for_payment_production', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedBigInteger('invoice_for_payment_id')
                ->comment('ID счета на оплату');
            $table->foreign(
                'invoice_for_payment_id',
                'invoices_for_payment_production_invoice_for_payment_id_foreign'
            )
                ->references('id')
                ->on('documents_invoices_for_payment')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedBigInteger('product_catalog_id')
                ->nullable()
                ->comment('ID продукта из каталога');
            $table->foreign(
                'product_catalog_id',
                'invoices_for_payment_production_product_catalog_id_foreign'
            )
                ->references('id')
                ->on('product_catalog')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->integer('quantity')
                ->comment('Количество');

            $table->float('price')
                ->nullable()
                ->comment('Цена с НДС');

            $table->float('nds')
                ->nullable()
                ->comment('НДС');

            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `documents_invoices_for_payment_production` COMMENT 'Продукция счетов на оплату'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_invoices_for_payment_production');
    }
}
