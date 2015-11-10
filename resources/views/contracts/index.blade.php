@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
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
<th><i class="icon-cog"></i></th>
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
<td>{{ $contract->profit_byyear}}</td>
<td>{{ $contract->invest_time }}</td>
 <?php $archivemoney=0;
        $archivemoney=$contract->deal_money*$contract->invest_time/12;
	  ?>
<td>{{ number_format(round($archivemoney,2)*10000) }}</td>
<td>{{ $contract->profit_bymonth}}%</td>
 
<td>{{ date('d', strtotime($contract->intrests_start_date))}}日</td>

<td>{{ number_format(floor($contract->intrests_money_bymonth))}}</td>


<td>{{ $contract->channel_cut}}%</td>

<td>{{ $contract->other }}</td>
<td><a href="{{ URL::route('contracts.edit', $contract->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('contracts/'.$contract->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete" data-title="删除" data-message="确认要删除此数据吗 ?">删除</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $contracts->links() }}

 <a href="{{ URL::route('contracts.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 </div>  
 @include('delconfirm')
@stop
@section('bootor')
@stop