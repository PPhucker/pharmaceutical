<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors_cars', static function (Blueprint $table) {
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

            $table->string('car_model', 20)
                ->comment('Марка');

            $table->string('state_number', 15)
                ->comment('Гос. номер');

            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement(
            "ALTER TABLE `contractors_cars` COMMENT 'Автомобили'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contractors_cars');
    }
}
