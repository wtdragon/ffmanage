@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>
<th>合同编号</th>
<th>客户名称</th>
<th>已分红期数</th>
<th>未分红期数</th>
<th>总期数</th>
<th>计划结息日</th>
<th>实际结息日</th>
<th>本金金额</th>
<th>利息金额</th>
<th>年利率%</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($intrests as $intrest)
<tr>
<?php   
       $parentcut=$contract->deal_money/100;
       $tqt=($contract->deal_money*$contract->channel_cut)/100;
	   $salescut=$contract->channel_cut-$position->depth;
	   $salecutmoney=($contract->channel_cut-$position->depth)*$contract->deal_money/100;
	  ?>	
<td>{{ $intrest->contract_id}}</td>
<td>{{ $intrest->customer->customer_name }}</td>
<td>{{ $intrest->bonused_time}}</td>
<td>{{ $intrest->rest_time }}</td>
<td>{{ $intrest->total_time}}</td>
<td>{{ $intrest->planinterest_date }}</td>
<td>{{ $intrest->realinterest_date}}</td>
<td>{{ $intrest->principal_money }}</td>
<td>{{ $intrest->interests_money }}</td>
<td>{{ $intrest->rate_bymonth}}%</td>
<td><a href="{{ URL::route('intrests.edit', $intrest->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('intrests/'.$intrest->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete" data-title="删除" data-message="确认删除 ?">删除</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
 </div>
 @include('delconfirm')   
@stop
@section('bootor')
@stop