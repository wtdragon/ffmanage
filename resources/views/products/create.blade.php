@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增产品</div>

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

          <form action="{{ URL('products') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             产品编码  
            <input type="text" name="product_id" class="form-control" required="required">
            <br>
             产品名称  
            <input type="text" name="product_name" class="form-control" required="required">
            <br>
            开始日期
             <input type="date" name="start_date" class="form-control" required="required">
            <br>
            结束日期
	      <input type="date" name="end_date" class="form-control" required="required">
            <br>
           
            <button class="btn btn-lg btn-info">新增产品</button>
          </form>

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop