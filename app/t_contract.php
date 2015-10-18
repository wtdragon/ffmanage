<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t_contract extends Model
{
    //
public function product()
{
    return $this->belongsTo('App\m_product', 'product_id');
}
 public function customer()
{
    return $this->belongsTo('App\t_customer', 'customer_id');
}
 public function employee()
{
    return $this->belongsTo('App\t_employee', 'sales_id');
}
}
