<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Command: php artisan make:migration create_roles_table
 */
class CreateRolesTable extends Migration
{
    private const TABLE_NAME = 'roles';

    /**
     * Run the migrations.
     *
     * @return void
     */
    final public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->comment('Название');
            $table->string('slug', 60)->comment('Токен');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `" . self::TABLE_NAME . "` COMMENT 'Роли пользователей'");
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
