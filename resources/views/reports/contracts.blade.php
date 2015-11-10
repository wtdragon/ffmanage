@extends('master')
@section('header')
@stop
@section('content')
<?php   $i=0;
       $parentcut=$contract->deal_money/100;
       $tqt=($contract->deal_money*$contract->channel_cut)/100;
	   $salescut=$contract->channel_cut-$position->depth;
	   $salecutmoney=($contract->channel_cut-$position->depth)*$contract->deal_money/100;
	  ?>
<div class="center" >
@if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>额~</strong> 各级提点总和应等于总渠道提点.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
@endif	
<form role="form" id="productform" action="/cdata"  method="POST" style="display: inline;">
<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
<p>合同编号:{{$contract->contract_id}}</p> 
<input type="hidden" name="contract_id" value="{{$contract->contract_id}}">
<p>
	出单人员：{{ $contract->employee->employee_name }}
</p> 
<p>
	出单日 期：{{ $contract->pay_date }}
</p> 
<div id="deal">
<p>
	金         额（万元）：{{ $contract->deal_money }}
</p>
</div> 

<p>
	年化收益(%)：{{ $contract->profit_byyear }}
</p> 
<div id="total">
<p>
	总渠道费比例%：{{ $contract->channel_cut }}
	  
</p> 
</div>
<div id="comcut">
<p>
	公司渠道费 比例%： <input id="ct" type="text" name="compnay_cut" class="form-control" value="0">
 
 </p>
</div>
<div id="dealcut" 
 <p>
	{{ $position->position_name }} {{ $position->employee->employee_name }} :成单人员提点比例<input type="text" name="employee_cut" class="form-control"  value="0">
	 
</p>
</div>
 @foreach ($parents as $parent)
 <?php $i++;
 ?>
 <div id="prcut{{ $i }}"
  <p>
  	{{ $parent->position_name }} : {{ $parent->employee->employee_name }} :上级人员提点比例:<input type="text" name="parent_cut_val{{ $i }}" class="form-control"  value="0">
    <input type="hidden" name="parent_username{{ $i }}" value="{{$parent->position_name}}: {{ $parent->employee->employee_name }}"> 
      
  </p>
 </div> 
 @endforeach
     <input type="hidden" name="parent_count" value="{{$i}}"> 
     
<button  type="submit" class="btn btn-default" target="_blank">生成报表</button>
 </div>
 </form>
 <script type="text/javascript">
  $(document).ready(function(){
    $('#expreport').click(function(){
       var dealmoney=$('#del').text();
       var totalper=$('#total').text();
        var dealcut=$('#dealcut').text();
        
      
       var comcut=$("#ct").attr("value");;
       	var prcut1=$('#prcut1').text();
       		var prcut2=$('#prcut2').text();
       			var prcut3=$('#prcut3').text();
       				var prcut4=$('#prcut4').text();
       var calper=comcut+dealcut+prcut1+prcut2+prcut3+prcut4
       if(calper != totalper){
    alert("各渠道取值之和不等全部渠道值，请重新输入+ totalper +");
     alert(comcut);
       }
    });
  });
</script>  
@stop
@section('bootor')
@stop