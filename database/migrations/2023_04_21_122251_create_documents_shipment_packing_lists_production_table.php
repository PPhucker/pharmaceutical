<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsShipmentPackingListsProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_shipment_packing_lists_production', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->comment('Пользователь, создавший документ');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedBigInteger('invoice_for_payment_id')
                ->comment('ID Счета на оплату');
            $table->foreign(
                'invoice_for_payment_id',
                'shipment_packing_lists_production_invoice_for_payment_id_foreign'
            )
                ->references('id')
                ->on('documents_invoices_for_payment')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedBigInteger('packing_list_id')
                ->comment('ID Товарной накладной');
            $table->foreign(
                'packing_list_id',
                'packing_lists_production_packing_list_id_foreign'
            )
                ->references('id')
                ->on('documents_shipment_packing_lists')
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('product_id')
                ->nullable()
                ->comment('ID Продукта из каталога');
            $table->foreign(
                'product_id',
                'packing_lists_production_product_id_foreign'
            )
                ->references('id')
                ->on('product_catalog')
                ->nullOnDelete();

            $table->string('series', 7)
                ->nullable()
                ->comment('Серия');

            $table->integer('quantity')
                ->comment('Количество');

            $table->float('price')
                ->comment('Цена с НДС');

            $table->float('nds')
                ->comment('НДС');

            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `documents_shipment_packing_lists_production` COMMENT 'Продукция товарных накладных'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_shipment_packing_lists_production');
    }
}
