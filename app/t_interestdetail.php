<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class t_interestdetail extends Model
{
    //
    use SoftDeletes;

protected $dates = ['deleted_at']; 
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
 public function employee()
{
    return $this->belongsTo('App\m_employee', 'sales_id');
}
}
