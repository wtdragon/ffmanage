@extends('master')
@section('header')
@stop
@section('content')
 <?php $pid=0;
       $tqt=0;
	   $tdm=0;
	  ?>
<div class="center" >
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-yw4l{vertical-align:top}
.tg .tg-b7b8{background-color:#f9f9f9;vertical-align:top}
</style>
<table class="tg">
	<tr>
    <th class="tg-yw4l" colspan="9">直销中心渠道费支付明细表（{{ $productname }}）<br></th>
  </tr>
  <tr>
    <th class="tg-yw4l">序号</th>
    <th class="tg-yw4l">合同编号<br></th>
    <th class="tg-yw4l">出单人</th>
    <th class="tg-yw4l">客户姓名<br></th>
    <th class="tg-yw4l">打款日期</th>
    <th class="tg-yw4l">成单金额<br>（万元）<br></th>
    <th class="tg-yw4l">年化收益<br>（%）<br></th>
    <th class="tg-yw4l">各职级渠道费<br>   （元）<br></th>
    <th class="tg-yw4l">    &nbsp; &nbsp; &nbsp;备注    &nbsp; &nbsp; &nbsp; <br></th>
  </tr>
  @foreach ($contracts as $contract)
   <?php $pid+=1;
         $pt=($contract->deal_money*$contract->channel_cut)/100;
		 $tqt+=$pt;
		 $tdm+=$contract->deal_money;
	  ?>
<tr>
<td>{{ $pid }}</td>
<td>{{ $contract->contract_id }}</td>
<td>{{ $contract->sales_id }}</td>
<td>{{ $contract->customer_id }}</td>
<td>{{ $contract->pay_date }}</td>
<td>{{ $contract->deal_money }}</td>
<td>{{ $contract->profit_byyear }}</td>
<td>{{ $pt }}</td>
<td>

</td>
</tr>
@endforeach
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>{{ $tdm }}</td>
<td></td>
<td>{{ $tqt }}</td>
<td>

</td>
</tr>
  <tr>
    <td class="tg-yw4l" colspan="9">注：市场渠道费至打款日期起一周内返回银行账户，收益部分期满半年返一次，期满一年返回剩余收益及本金<br></td>
  </tr>
  <tr>
    <td class="tg-b7b8" colspan="9">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;  7.1开始T+7渠道费核算打包点位为19.5%<br></td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="9">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 即：直销中心应发费用={{ $tqt }}<br></td>
  </tr>
  <tr>
    <td class="tg-b7b8" colspan="9">制表人：&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 财务复核：&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 财务经理：&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 总经理签字：&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; 总裁签字：&nbsp;&nbsp; &nbsp; &nbsp; <br></td>
  </tr>
</table>
 </div>  
 
@stop
@section('bootor')
@stop