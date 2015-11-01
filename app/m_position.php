<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_position extends \Baum\Node
{
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
