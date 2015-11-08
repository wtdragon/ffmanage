@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>
<th>合同编号</th>
<th>客户姓名</th>
<th>已分红期数</th>
<th>未分红期数</th>
<th>总期数</th>
<th>计划结息日</th>
<th>实际结息日</th>
<th>本金金额</th>
<th>利息金额</th>

<th>年利率%</th>
<th>是否已结息</th>
<th>备注</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($intrests as $intrest)
<tr>

<td>{{ $intrest->contract_id}}</td>
<td>{{ $intrest->customer->customer_name}}</td>
<td>{{ $intrest->bonused_time}}</td>
<td>{{ $intrest->rest_time }}</td>
<td>{{ $intrest->total_time}}</td>
<td>{{ $intrest->planinterest_date }}</td>
<td>{{ $intrest->realinterest_date}}</td>
<td>{{ $intrest->principal_money }}</td>
<td>{{ $intrest->interests_money }}</td>

<td>{{ $intrest->profit_byyear}}%</td>
@if($intrest->have_intrests===0)
<td>否</td>
<td>{{ $intrest->other }}</td>
<td><a href="{{ URL::route('intrests.edit', $intrest->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>

@else
<td>是</td>
<td>{{ $intrest->other }}</td>
<td></td>
@endif
 
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