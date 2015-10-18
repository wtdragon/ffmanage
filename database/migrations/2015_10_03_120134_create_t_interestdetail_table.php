<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTInterestdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
		Schema::create('t_interestdetails', function ($table) {
            //
            $table->increments('id');
			$table->timestamps();
			$table->integer('contract_id'); 
			$table->date('planinterest_date'); 
			$table->date('realinterest_date');
			$table->float('interests_money'); 
			$table->float('rate_bymonth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_interestdetails', function (Blueprint $table) {
            //
        });
    }
}
