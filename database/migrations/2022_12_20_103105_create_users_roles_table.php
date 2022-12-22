<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Command: php artisan make:migration create_users_roles_table
 */
class CreateUsersRolesTable extends Migration
{
    private const TABLE_NAME = 'users_roles';

    /**
     * Run the migrations.
     *
     * @return void
     */
    final public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->comment('ID пользователя');
            $table->unsignedBigInteger('role_id')->comment('ID роли');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->primary(['user_id', 'role_id']);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `" . self::TABLE_NAME . "` COMMENT 'Права пользователей'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    final public function down(): void
    {
        Schema::drop(self::TABLE_NAME);
    }
}
