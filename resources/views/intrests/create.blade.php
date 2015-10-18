@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增分红</div>

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

          <form action="{{ URL('intrests') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             合同编号  
            <input type="text" name="contract_id" class="form-control" required="required">
            <br>
            计划分红日期
             <input type="date" name="planinterest_date" class="form-control" required="required">
            <br>
            实际分红日期
	      <input type="date" name="realinterest_date" class="form-control" required="required">
            <br>
            分红金额
	      <input type="text" name="interests_money" class="form-control" required="required">
            <br>
            月利率
	     <input type="text" name="rate_bymonth" class="form-control" required="required">
            <br>
            <button class="btn btn-lg btn-info">新增分红</button>
          </form>

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop