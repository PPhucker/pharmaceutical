<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsBankAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations_bank_account_details', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->default(1);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();
            $table->char('bank', 9)
                ->nullable();
            $table->foreign('bank')
                ->references('BIC')
                ->on('classifier_banks')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->char('payment_account', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations_bank_account_details');
    }
}
