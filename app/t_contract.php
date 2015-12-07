<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class t_contract extends Model
{
    //
    use SoftDeletes;

protected $dates = ['deleted_at']; 
public function product()
{
    return $this->belongsTo('App\m_product', 'product_id');
}
 public function customer()
{
    return $this->belongsTo('App\m_customer', 'customer_id');
}
 public function employee()
{
    return $this->belongsTo('App\m_employee', 'sales_id');
}
}
