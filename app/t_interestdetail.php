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
 public function customer()
{
    return $this->belongsTo('App\m_customer', 'customer_id');
}
   public function product()
{
    return $this->belongsTo('App\m_product', 'product_id');
}
}
