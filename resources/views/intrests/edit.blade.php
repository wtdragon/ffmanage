@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">编辑分红</div>

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
	 <form action="{{ URL('intrests/'.$interest->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             合同编号  
            <input type="text" name="contract_id" class="form-control" required="required" value="{{ $interest->contract_id }}">
            <br>
            计划分红日期
             <input type="text" name="planinterest_date" class="form-control" required="required" value="{{ $interest->planinterest_date }}">
            <br>
            实际分红日期
	      <input type="text" name="realinterest_date" class="form-control" required="required" value="{{ $interest->realinterest_date }}">
            <br>
            分红金额
	      <input type="text" name="interests_money" class="form-control" required="required" value="{{ $interest->interests_money }}">
            <br>
                                 年利率%
	     <input type="text" name="rate_bymonth" class="form-control" required="required" value="{{ $interest->rate_bymonth }}">
            <br>
            <button class="btn btn-lg btn-info">修改分红</button>
                       </form>
 

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop