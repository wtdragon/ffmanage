@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-sm-6">
<form role="form" id="productform" action="/prodreports">
   <div class="form-group">
      <label for="name">产品名称</label>
      <select class="form-control" name="productname">
      	@foreach ($products as $product)
         <option>{{ $product->product_name }}</option>
         @endforeach
      </select>

      <label for="name">日期范围</label>
        <input type="text" class="form-control" name="begintime" 
            placeholder="开始日期">~
          <input type="text" class="form-control" name="endtime" 
            placeholder="结束日期">   
        <button type="submit" class="btn btn-default" target="_blank">生成产品支付明细报表</button>
   </div>
</form>
 </div>  
 <div class="col-sm-6">
<form role="form" id="productform" action="/contractreports">
   <div class="form-group">
      <label for="name">合同号</label>
      <select class="form-control" name="contractid">
      	 @foreach ($contracts as $contract)
         <option> {{ $contract->contract_id}}</option>
         @endforeach
      </select>

      <label for="name">日期范围</label>
        <input type="text" class="form-control" name="begintime" 
            placeholder="开始日期">~
          <input type="text" class="form-control" name="endtime" 
            placeholder="结束日期">   
        <button type="submit" class="btn btn-default" target="_blank">生成提点报表</button>
   </div>
</form>
 </div>  
 </div>  
@stop
@section('bootor')
@stop