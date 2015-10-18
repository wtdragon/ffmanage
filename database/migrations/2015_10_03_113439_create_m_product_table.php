<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
		Schema::create('m_products', function ($table) {
            //
            $table->increments('id');
			$table->timestamps();
			$table->integer('product_name');
			$table->date('start_date');
			$table->date('end_date'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_products', function (Blueprint $table) {
            //
        });
    }
}
