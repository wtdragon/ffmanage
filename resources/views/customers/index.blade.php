@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>
<th>客户姓名</th>
<th>银行卡所属银行</th>
<th>银行卡号</th>
<th>联系方式</th>
<th>身份证号</th>
<th>邮寄地址</th>
<th>邮编</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($customers as $customer)
<tr>
	
<td>{{ $customer->customer_name}}</td>
<td>{{ $customer->bank_name }}</td>
<td>{{ $customer->card_num}}</td>
<td>{{ $customer->phone_num }}</td>
<td>{{ $customer->personal_id}}</td>
<td>{{ $customer->address }}</td>
<td>{{ $customer->zip}}</td>
<td><a href="{{ URL::route('customers.edit', $customer->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('customers/'.$customer->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete" data-title="删除" data-message="确认要删除此数据吗 ?">删除</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
 {!! $customers->render() !!}
 
<a href="{{ URL::route('customers.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 
 </div>
  @include('delconfirm')     
@stop
@section('bootor')
@stop