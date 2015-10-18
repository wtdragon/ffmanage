<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
		Schema::create('m_employees', function ($table) {
            //
            $table->increments('id');
			$table->timestamps();
			$table->integer('employee_name'); 
			$table->string('gender',100); 
			$table->integer('position_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_employees', function (Blueprint $table) {
            //
        });
    }
}
