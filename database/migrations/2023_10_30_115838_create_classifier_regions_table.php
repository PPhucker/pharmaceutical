<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for region table.
 */
class CreateClassifierRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('classifier_regions', static function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)
                ->comment('Название региона');
            $table->text('zone')
                ->nullable()
                ->comment('Зона региона (опционально)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('classifier_regions');
    }
}
