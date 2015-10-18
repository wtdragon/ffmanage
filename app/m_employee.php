<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_employee extends Model
{
    //
     protected $table = 'm_employees';
	 public function position()
{
    return $this->belongsTo('App\m_position', 'position_id');
}
}
