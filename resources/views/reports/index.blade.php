@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>
<th>产品编码</th>
<th>产品名称</th>
<th>开始日期</th>
<th>结束日期</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($products as $product)
<tr>
<td>{{ $product->product_id}}</td>	
<td>{{ $product->product_name}}</td>
<td>{{ $product->start_date }}</td>
<td>{{ $product->end_date}}</td>

<td><a href="{{ URL::route('products.edit', $product->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('products/'.$product->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger">删除</button>
            </form>
</td>
</tr>
@endforeach
</tbody>
</table>
<a href="{{ URL::route('products.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 
 </div>  
@stop
@section('bootor')
@stop