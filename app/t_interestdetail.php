<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t_interestdetail extends Model
{
    //
    public function contract()
{
    return $this->belongsTo('App\t_contract', 'contract_id');
}
}
