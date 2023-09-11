<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('contractors_contracts', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('created_by_id')
                ->nullable();
            $table->foreign('created_by_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedBigInteger('updated_by_id')
                ->nullable();
            $table->foreign('updated_by_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->unsignedBigInteger('organization_id')
                ->comment('ID Организации');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('contractor_id')
                ->comment('ID Контрагента');
            $table->foreign('contractor_id')
                ->references('id')
                ->on('contractors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('number', 20)
                ->nullable()
                ->comment('Номер');

            $table->date('date')
                ->comment('Дата заключения');

            $table->text('comment')
                ->nullable()
                ->comment('Примечание');

            $table->boolean('is_valid')
                ->comment('Действителен');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors_contracts');
    }
}
