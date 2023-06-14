<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->default(1);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->string('legal_form_type', 15)
                ->nullable();
            $table->foreign('legal_form_type')
                ->references('abbreviation')
                ->on('classifier_legal_forms')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('name', 120);
            $table->string('INN', 12)
                ->unique();
            $table->string('OKPO', 10);
            $table->string('contacts', 120)
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
        Schema::dropIfExists('organizations');
    }
}
