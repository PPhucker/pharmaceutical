<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsPlacesOfBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations_places_of_business', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->default(1);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->char('identifier', 14)
                ->nullable()
                ->unique();
            $table->boolean('registered');
            $table->char('index', 6);
            $table->string('address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations_places_of_business');
    }
}
