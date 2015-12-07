@extends('master')
@section('header')

@stop
@section('content')

<div class="center" >
	@if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>额~</strong>  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
                <br><br>
               
            </div>
@endif	
<div class="row">
<div class="col-sm-6">
<form role="form" id="productform" action="/prodreports" style="border-style:solid;height:250px">
   <div class="form-group">
      <label for="name">依照产品名称</label>
      <select class="form-control" name="productname">
      	@foreach ($products as $product)
         <option>{{ $product->product_name }}</option>
         @endforeach
      </select>
        <label for="name">日期范围</label>
        <input type="date" class="form-control" name="start_date" 
            placeholder="开始日期">~
          <input type="date" class="form-control" name="end_date" 
            placeholder="结束日期"> 
 
 
        <button type="submit" class="btn btn-default" target="_blank">生成产品支付明细报表</button>
   </div>
</form>
 </div>  
 <div class="col-sm-6">
<form role="form" id="productform" action="/contractreports" style="border-style:solid;height:250px">
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
<form role="form" id="productform" action="/ctrreports" style="border-style:solid;height:250px">
   <div class="form-group">
      <label for="name">依照产品名称</label>
      <select class="form-control" name="productname">
      	@foreach ($products as $product)
         <option>{{ $product->product_name }}</option>
         @endforeach
      </select>
      
    <label for="name">日期范围</label>
        <input type="date" class="form-control" name="start_date" 
            placeholder="开始日期">~
          <input type="date" class="form-control" name="end_date" 
            placeholder="结束日期"> 
  
 
        <button type="submit" class="btn btn-default" target="_blank">生成合同记录报表</button>
   </div>
</form>
 </div>  
 <div class="col-sm-6">
<form role="form" id="productform" action="/cusreports" style="border-style:solid;height:250px">
   <div class="form-group">
      
   <label for="name">日期范围</label>
        <input type="date" class="form-control" name="start_date" 
            placeholder="开始日期">~
          <input type="date" class="form-control" name="end_date" 
            placeholder="结束日期"> 
   
     <select class="form-control" name="return_intrest" >
   
      <option value="1">是否结息</option>
       <option value="2">是</option>
        <option value="3">否</option>
      
     
    
  </select>   
      <select class="form-control" name="intrests_found" >
   
      <option value="1">返本返息</option>
       <option value="2">返息</option>
        <option value="3">返本息</option>
  
     
    
  </select>  
        <button type="submit" class="btn btn-default" target="_blank">生成客户分红明细报表</button>
   </div>
</form>
 </div>  
 </div> 
 
     
 </div>  
@stop
@section('bootor')
@stop