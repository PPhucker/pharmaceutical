<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    private const TABLE_NAME = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    final public function up()
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->comment('ФИО');
            $table->string('email', 60)->unique()->comment('E-mail');
            $table->timestamp('email_verified_at')->nullable()->comment('Время подтверждения e-mail');
            $table->string('password')->comment('Пароль');
            $table->rememberToken()->comment('Токен запомненного пользователя');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `" . self::TABLE_NAME . "` COMMENT 'Пользователи'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    final public function down()
    {
        Schema::drop(self::TABLE_NAME);
    }
}
