<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToDocumentsInvoicesForPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents_invoices_for_payment', static function (Blueprint $table) {
            $table->string('filling_type', 20)
                ->nullable()
                ->default('production')
                ->comment('Наполнение счета (Продукция, комплектующие и тд.)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents_invoices_for_payment', static function (Blueprint $table) {
            //
        });
    }
}
