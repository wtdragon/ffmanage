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
<th>职位提点</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($products as $product)
<tr>
<td>{{ $product->product_id}}</td>	
<td>{{ $product->product_name}}</td>
<td>{{ $product->pos_intrests }}</td>

<td><a href="{{ URL::route('products.edit', $product->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('products/'.$product->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete" data-title="删除" data-message="确认要删除此数据吗 ?">删除</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $products->links() }}
<a href="{{ URL::route('products.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 
 </div>  
 @include('delconfirm')   
@stop
@section('bootor')
@stop