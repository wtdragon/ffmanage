<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    //
    protected $table = 'users_groups';
    
    public function group()
{
    return $this->belongsTo('App\Group', 'group_id');
}
}
