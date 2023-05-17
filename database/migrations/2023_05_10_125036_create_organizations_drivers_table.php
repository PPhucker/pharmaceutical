<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations_drivers', static function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->default(1)
                ->comment('Пользователь');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->unsignedBigInteger('organization_id')
                ->comment('ID Организации');

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('name')
                ->comment('ФИО Водителя');

            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `organizations_drivers` COMMENT 'Водители'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations_drivers');
    }
}
