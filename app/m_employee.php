<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class m_employee extends Model
{
    //
     use SoftDeletes;

     protected $dates = ['deleted_at'];
     protected $table = 'm_employees';
	 public function position()
{
    return $this->belongsTo('App\m_position', 'position_id');
}
}
