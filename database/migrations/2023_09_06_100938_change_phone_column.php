<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePhoneColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contractors_contact_persons', function (Blueprint $table) {
            $table->string('phone', 60)
                ->nullable()
                ->comment('Телефон')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contractors_contact_persons', function (Blueprint $table) {
            //
        });
    }
}
