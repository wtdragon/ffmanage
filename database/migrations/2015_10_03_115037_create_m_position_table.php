<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('m_positions', function ($table) {
            //
            $table->increments('id');
			$table->timestamps();
			$table->integer('department_id'); 
			$table->string('department_name'); 
			$table->date('start_date'); 
			$table->date('end_date');
			$table->integer('employee_id'); 
			$table->integer('leader_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_positions', function (Blueprint $table) {
            //
        });
    }
}
