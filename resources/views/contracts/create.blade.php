@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增合同</div>

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

          <form action="{{ URL('contracts') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             合同编码
            <input type="text" name="contract_id" class="form-control" required="required">
            <br>
         产品编码
            <input type="text" name="product_id" class="form-control" required="required">
            <br>       
            客户编码
             <input type="text" name="customer_id" class="form-control" required="required">
            <br>
            销售人员编码
	      <input type="text" name="sales_id" class="form-control" required="required">
            <br>
            付款方式
	      <input type="text" name="pay_mothod" class="form-control" required="required">
            <br>
            付款日期
	     <input type="date" name="pay_date" class="form-control" required="required">
	        <br>
	  付款时间
            <input type="time" name="pay_time" class="form-control" required="required">
            <br>
            成交金额(万元)
             <input type="text" name="deal_money" class="form-control" required="required">
            <br>
            年化收益
	      <input type="text" name="profit_byyear" class="form-control" required="required">
            <br>
            投资期限
	      <input type="text" name="invest_time" class="form-control" required="required">
            <br>
            渠道提成(%)
	     <input type="text" name="channel_cut" class="form-control" required="required">
            <br>
            <button class="btn btn-lg btn-info">新增合同</button>
          </form>

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop
