<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_contracts', function ($table) {
            //
            $table->increments('id');
			$table->timestamps();
			$table->integer('product_id');
			$table->integer('customer_id'); 
			$table->integer('sales_id');
			$table->string('pay_mothod',100); 
			$table->date('pay_date');
			$table->time('pay_time'); 
			$table->integer('deal_money');
			$table->float('profit_byyear'); 
			$table->integer('invest_time');
			$table->float('channel_cut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_contracts', function (Blueprint $table) {
            //
        });
    }
}
