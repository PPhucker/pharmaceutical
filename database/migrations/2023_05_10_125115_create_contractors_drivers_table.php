<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors_drivers', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->default(1)
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->unsignedBigInteger('contractor_id')
                ->comment('ID Контрагента');

            $table->foreign('contractor_id')
                ->references('id')
                ->on('contractors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('name')
                ->comment('ФИО Водителя');

            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `contractors_drivers` COMMENT 'Водители'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contractors_drivers');
    }
}
