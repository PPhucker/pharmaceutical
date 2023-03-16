<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassifierEndProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifier_end_products', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->default(1)
                ->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
            $table->unsignedBigInteger('type_id')
                ->nullable()
                ->comment('Тип готовой продукции');
            $table->foreign('type_id')
                ->references('id')
                ->on('classifier_types_of_end_products')
                ->nullOnDelete();
            $table->unsignedBigInteger('international_name_id')
                ->nullable()
                ->comment('Межд. непатент. название');
            $table->foreign('international_name_id')
                ->references('id')
                ->on('classifier_international_names_of_end_products')
                ->nullOnDelete();
            $table->unsignedBigInteger('registration_number_id')
                ->nullable()
                ->comment('Регистрационный номер');
            $table->foreign('registration_number_id')
                ->references('id')
                ->on('classifier_registration_numbers_of_end_products')
                ->nullOnDelete();
            $table->string('okei_code', 10)
                ->nullable()
                ->comment('Код ОКЕИ');
            $table->foreign('okei_code')
                ->references('code')
                ->on('classifier_okei')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('okpd2_code', 20)
                ->nullable()
                ->comment('Код ОКПД2');
            $table->foreign('okpd2_code')
                ->references('code')
                ->on('classifier_okpd2')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            /*$table->unsignedBigInteger('mdlp_id')
                ->nullable()
                ->comment('ID из mdlp.iz');*/
            /*$table->char('GTIN', 14)
                ->nullable()
                ->comment('Global Trade Item Number');*/
            $table->string('short_name', 50)
                ->comment('Краткое название');
            $table->string('full_name', 150)
                ->comment('Полное название');
            $table->boolean('marking')
                ->comment('Маркировка (1-да/0-нет)');
            $table->integer('best_before_date')
                ->comment('Срок годности (в месяцах)');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement(
            "ALTER TABLE `classifier_end_products` COMMENT 'Классификатор готовой продукции'"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifier_end_products');
    }
}
