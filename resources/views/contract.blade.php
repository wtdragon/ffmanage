  <meta charset="utf-8">
<?php   
       $parentcut=$contract->deal_money/100;
       $tqt=($contract->deal_money*$contract->channel_cut)/100;
	   $salescut=$contract->channel_cut-$position->depth;
	   $salecutmoney=($contract->channel_cut-$position->depth)*$contract->deal_money/100;
	  ?>
 
 
<p>
	出单人员：{{ $contract->employee->employee_name }}
</p> 
<p>
	日         期：{{ $contract->pay_date }}
</p> 
<p>
	金         额：{{ $contract->deal_money }}万元
</p> 
<p>
	年化收益(%)：{{ $contract->sales_id }}%
</p> 
<p>
	总渠道费比例：{{ $contract->channel_cut }}
</p> 
<p>
	既：市场各职级渠道费为{{ $contract->deal_money }}X{{ $contract->channel_cut }}%={{ $tqt }}
</p> 
 
 <p>
	{{ $position->position_name }} {{ $position->employee->employee_name }} :市场各职级渠道费{{  $salescut }}%:{{ $contract->deal_money }}万X{{  $salescut }}%={{  $salecutmoney }}
</p>
 @foreach ($parents as $parent)
  <p>
  	{{ $parent->position_name }} {{ $parent->employee->employee_name }} :市场各职级渠道费1%:{{ $contract->deal_money }}万X1%={{  $parentcut }}

  </p>
 @endforeach
    <p>
    	制表人：&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 审核人：&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 总经理：&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 
    </p>
 
 