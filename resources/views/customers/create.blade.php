@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增客户信息</div>

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

          <form action="{{ URL('customers') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             客户姓名  
            <input type="text" name="customer_name" class="form-control" required="required" >
            <br>
            银行卡所属银行
             <input type="text" name="bank_name" class="form-control" required="required" >
            <br>
            银行卡号
	      <input type="text" name="card_num" class="form-control" required="required" >
            <br>
            手机号
	      <input type="text" name="phone_num" class="form-control" required="required" >
            <br>
            身份证号码
	     <input type="text" name="personal_id" class="form-control" required="required" >
            <br>
            地址
	      <input type="text" name="address" class="form-control" required="required" >
            <br>
            邮编
	     <input type="text" name="zip" class="form-control" required="required" >
            <br>
            <button class="btn btn-lg btn-info">新增客户信息</button>
          </form>

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop