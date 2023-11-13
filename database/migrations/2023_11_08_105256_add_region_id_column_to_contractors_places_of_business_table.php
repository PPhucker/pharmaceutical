<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Добавление столбца region_id в contractors_places_of_business.
 */
class AddRegionIdColumnToContractorsPlacesOfBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('contractors_places_of_business', static function (Blueprint $table) {
            $table->unsignedBigInteger('region_id')
                ->nullable()
                ->comment('ID региона');

            $table->foreign('region_id')
                ->references('id')
                ->on('classifier_regions')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });

        DB::statement(
            'alter table contractors_places_of_business
                modify `region_id` bigint unsigned null after `index`;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::statement(
            'alter table contractors_places_of_business
                drop column `region_id`;'
        );
    }
}
