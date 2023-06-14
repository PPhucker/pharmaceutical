<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsContactPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors_contact_persons', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contractor_id');
            $table->foreign('contractor_id')
                ->references('id')
                ->on('contractors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name', 50);
            $table->string('post', 50)
                ->nullable();
            $table->string('phone', 15)
                ->nullable();
            $table->string('email')
                ->nullable();
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
        Schema::dropIfExists('contractors_contact_persons');
    }
}
