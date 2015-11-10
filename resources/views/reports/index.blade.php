@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="row">
<div class="col-sm-6">
<form role="form" id="productform" action="/prodreports" style="border-style:solid;height:200px">
   <div class="form-group">
      <label for="name">依照产品名称</label>
      <select class="form-control" name="productname">
      	@foreach ($products as $product)
         <option>{{ $product->product_name }}</option>
         @endforeach
      </select>
      
      <label for="name">时间期限</label>
  <select class="form-control" name="timerange">
      <option value="1">本周</option>
       <option value="2">本月</option>
        <option value="3">本季度</option>
        <option value="4">半年度</option>
        
         <option value="5">本年度</option>
    
  </select>  
 
        <button type="submit" class="btn btn-default" target="_blank">生成产品支付明细报表</button>
   </div>
</form>
 </div>  
 <div class="col-sm-6">
<form role="form" id="productform" action="/contractreports" style="border-style:solid;height:200px">
   <div class="form-group">
      <label for="name">依据合同号生成提点</label>
      <select class="form-control" name="contractid">
      	 @foreach ($contracts as $contract)
         <option> {{ $contract->contract_id}}</option>
         @endforeach
      </select>

      <button type="submit" class="btn btn-default" target="_blank">生成提点报表</button>
   </div>
</form>
</div>
<div class="col-sm-6">
<form role="form" id="productform" action="/prodreports" style="border-style:solid;height:200px">
   <div class="form-group">
      <label for="name">依照产品名称</label>
      <select class="form-control" name="productname">
      	@foreach ($products as $product)
         <option>{{ $product->product_name }}</option>
         @endforeach
      </select>
      
      <label for="name">时间期限</label>
  <select class="form-control" name="timerange">
      <option value="1">本周</option>
       <option value="2">本月</option>
        <option value="3">本季度</option>
        <option value="4">半年度</option>
        
         <option value="5">本年度</option>
    
  </select>  
 
        <button type="submit" class="btn btn-default" target="_blank">生成合同记录报表</button>
   </div>
</form>
 </div>  
 <div class="col-sm-6">
<form role="form" id="productform" action="/prodreports" style="border-style:solid;height:200px">
   <div class="form-group">
      <label for="name">依照合同号</label>
      <select class="form-control" name="productname">
       @foreach ($contracts as $contract)
         <option> {{ $contract->contract_id}}</option>
         @endforeach
      </select>
      
      <label for="name">时间期限</label>
  <select class="form-control" name="timerange">
      <option value="1">本周</option>
       <option value="2">本月</option>
        <option value="3">本季度</option>
        <option value="4">半年度</option>
        
         <option value="5">本年度</option>
    
  </select>  
 
        <button type="submit" class="btn btn-default" target="_blank">生成客户分红明细报表</button>
   </div>
</form>
 </div>  
 </div> 
 
  <div class="col-sm-12">
 <p>
 	<label for="name">时间区间解释：</label>
 	<p>本周为系统时间减7天，例如系统登录时间为周五，本周数据则为上周六至周五当天所有产品相关合同</p>
 	<p>本月为系统时间减30天，例如系统登录时间为周五，本月数据则周五的日期前30天至周五当天所有产品相关合同</p>
 	<p>本季度为系统时间减90天，例如系统登录时间为周五，本季度数据则周五的日期前90天至周五当天所有产品相关合同</p>
 	<p>半年度为系统时间减180天，例如系统登录时间为周五，半年数据则周五的日期前180天至周五当天所有产品相关合同</p>
 	
 	<p>本年度为系统时间减360天，例如系统登录时间为周五，年度数据则周五的日期前360天至周五当天所有产品相关合同</p>
 	

 </p>
  </div>     
 </div>  
@stop
@section('bootor')
@stop