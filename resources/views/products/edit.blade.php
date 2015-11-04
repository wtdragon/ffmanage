@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">编辑产品</div>

        <div class="panel-body">

           @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>额~</strong> 填写出错.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
	 <form action="{{ URL('products/'.$product->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             产品名称 
            <input type="text" name="product_id" class="form-control" required="required" value="{{ $product->product_id }}">
           
            产品名称  
            <input type="text" name="product_name" class="form-control" required="required" value="{{ $product->product_name }}">
            <br>
           开始日期
             <input type="date" name="start_date" class="form-control" required="required" value="{{ $product->start_date }}">
            <br>
            结束日期
             <input type="date" name="end_date" class="form-control" required="required" value="{{ $product->end_date }}">
            <br>
    
            <button class="btn btn-lg btn-info">修改产品</button>
                       </form>
 

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop