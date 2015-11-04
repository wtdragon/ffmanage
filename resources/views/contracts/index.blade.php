@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>
<th>合同编码</th>	
<th>产品名称</th>
<th>客户名称</th>
<th>销售人员名称</th>
<th>付款方式</th>
<th>付款日期</th>
<th>起息日期</th>
<th>付款时间</th>
<th>成交金额(万元）)</th>
<th>年化收益</th>
<th>投资期限</th>
<th>员工业绩</th>
<th>渠道提成(%)</th>
<th>备注</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($contracts as $contract)
<tr>
<td>{{ $contract->contract_id}}</td>	
<td>{{ $contract->product_id}}</td>
<td>{{ $contract->customer_id }}</td>
<td>{{ $contract->sales_id}}</td>
<td>{{ $contract->pay_mothod }}</td>
<td>{{ $contract->pay_date}}</td>
<td>{{ $contract->intrests_start_date}}</td>
<td>{{ $contract->pay_time}}</td>
<td>{{ $contract->deal_money }}</td>
<td>{{ $contract->profit_byyear}}</td>
<td>{{ $contract->invest_time }}</td>
<td>{{ $contract->achive_money }}</td>
<td>{{ $contract->channel_cut}}%</td>
<td>{{ $contract->other }}</td>
<td><a href="{{ URL::route('contracts.edit', $contract->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('contracts/'.$contract->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger">删除</button>
            </form>
</td>
</tr>
@endforeach
</tbody>
</table>
<a href="{{ URL::route('contracts.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 
 </div>  
@stop
@section('bootor')
@stop