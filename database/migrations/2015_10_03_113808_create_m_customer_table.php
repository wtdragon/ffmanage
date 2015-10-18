<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
		Schema::create('m_customers', function ($table) {
            //
            $table->increments('id');
			$table->timestamps();
			$table->integer('customer_name'); 
			$table->string('bank_name',100); 
			$table->string('card_num',100);
			$table->string('personal_id',100); 
			$table->string('address');
			$table->string('zip'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_customers', function (Blueprint $table) {
            //
        });
    }
}
