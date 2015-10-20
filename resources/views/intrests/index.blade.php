@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>
<th>合同号</th>
<th>计划结息日</th>
<th>实际结息日</th>
<th>利息金额</th>
<th>月利率%</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($intrests as $intrest)
<tr>
	
<td>{{ $intrest->contract_id}}</td>
<td>{{ $intrest->planinterest_date }}</td>
<td>{{ $intrest->realinterest_date}}</td>
<td>{{ $intrest->interests_money }}</td>
<td>{{ $intrest->rate_bymonth}}%</td>
<td><a href="{{ URL::route('intrests.edit', $intrest->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('intrests/'.$intrest->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger">删除</button>
            </form>
</td>
</tr>
@endforeach
</tbody>
</table>
<a href="{{ URL::route('intrests.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 
 </div>  
@stop
@section('bootor')
@stop