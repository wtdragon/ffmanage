<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class m_position extends \Baum\Node
{
  use SoftDeletes;

  protected $dates = ['deleted_at']; 
  protected $table = 'm_positions';

  // 'parent_id' column name
  protected $parentColumn = 'leader_id';

  // 'lft' column name
  protected $leftColumn = 'lft';

  // 'rgt' column name
  protected $rightColumn = 'rgt';

  // 'depth' column name
  protected $depthColumn = 'depth';

  // guard attributes from mass-assignment
  protected $guarded = array('id', 'leader_id', 'lft', 'rgt', 'depth');
  
 public function employee()
{
    return $this->belongsTo('App\m_employee', 'employee_id');
}
public function leader()
{
    return $this->belongsTo('App\m_employee', 'leader_id');
}
}
