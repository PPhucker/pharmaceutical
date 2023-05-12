<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTrailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations_trailers', static function (Blueprint $table) {
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

            $table->string('type', 5)
                ->comment('Тип прицепа');

            $table->string('state_number', 15)
                ->comment('Гос. номер');

            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement(
            "ALTER TABLE `organizations_trailers` COMMENT 'Прицепы'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations_trailers');
    }
}
