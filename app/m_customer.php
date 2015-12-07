<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class m_customer extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
}
