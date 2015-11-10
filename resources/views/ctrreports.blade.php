  <meta charset="utf-8">
 <?php $pid=0;
       $adl=0;
	   $tdm=0;
	  ?>
<p>产品{{$productname}} 下所有合同</p>
<table class="table table-bordered">
<thead>
<tr>
<th>付款方式</th>	
<th>付款时间</th>

<th>合同编号</th>	
<th>产品名称</th>
<th>出单人</th>
<th>客户姓名</th>


<th>打款日期</th>

<th>成单金额(万元）</th>
<th>年化收益(%)</th>
<th>投资期限</th>
<th>员工业绩（元）</th>
<th>月利率</th>

<th>按月返息日</th>
<th>按月返息金额(元)</th>

<th>渠道提成(%)</th>
<th>备注</th>
</tr>
</thead>
<tbody>
 @foreach ($contracts as $contract)
<tr>
<td>{{ $contract->pay_mothod }}</td>

<td>{{ $contract->pay_time}}</td>
	
<td>{{ $contract->contract_id}}</td>	
<td>{{ $contract->product->product_name}}</td>
<td>{{ $contract->employee->employee_name}}</td>

<td>{{ $contract->customer->customer_name }}</td>

<td>{{ $contract->pay_date}}</td>
<td>{{ $contract->deal_money }}</td>
 <?php  
        $adl+=$contract->deal_money;
	  ?>
<td>{{ $contract->profit_byyear}}</td>
<td>{{ $contract->invest_time }}</td>
 <?php $archivemoney=0;
        $archivemoney=$contract->deal_money*$contract->invest_time/12;
	    $tdm+= 	number_format(floor($contract->intrests_money_bymonth));
	  ?>
<td>{{ number_format(round($archivemoney,2)*10000) }}</td>
<td>{{ $contract->profit_bymonth}}%</td>
 
<td>{{ date('d', strtotime($contract->intrests_start_date))}}日</td>

<td>{{ number_format(floor($contract->intrests_money_bymonth))}}</td>


<td>{{ $contract->channel_cut}}%</td>

<td>{{ $contract->other }}</td>
@endforeach


<tr>
<td></td>

<td></td>
	
<td></td>	
<td></td>
<td></td>

<td></td>

<td></td>
<td>{{ $adl }}</td>
<td></td>
<td></td>
<td></td>
<td></td>
 
<td></td>

<td></td>


<td></td>

<td></td>




</tbody>
</table>
<p>
	&nbsp;&nbsp;
</p>
<p>
	&nbsp;&nbsp;
</p>
<p>
	&nbsp;&nbsp;
</p>
<tr>
    <td class="tg-b7b8" colspan="9">制表人：&nbsp;&nbsp;                    &nbsp; &nbsp; &nbsp; &nbsp; 财务复核：&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 财务经理：&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 总经理签字：&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; 总裁签字：&nbsp;&nbsp; &nbsp; &nbsp; <br></td>
  </tr>  
 