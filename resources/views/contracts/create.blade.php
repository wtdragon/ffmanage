@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增合同</div>
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
        <div class="panel-body">

          

          <form action="{{ URL('contracts') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             合同编码
            <input type="text" name="contract_id" class="form-control" required="required">
            <br>
                              产品名称:
           
  <div class="form-group"> 
  <select class="form-control" name="product_id">
  	@foreach($products as $product)
      <option value="{{$product->product_id}}">{{$product->product_name}}</option>
    @endforeach
  </select>  
  </div>
    <br>       
            客户名称:
            <div class="form-group"> 
  <select class="form-control" name="customer_id">
  	@foreach($customers as $customer)
      <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
    @endforeach
  </select>  
  </div>
           
            <br>
            销售人员名称:
            <div class="form-group"> 
  <select class="form-control" name="sales_id">
  	@foreach($sales as $sale)
      <option value="{{$sale->id}}">{{$sale->employee_name}}</option>
    @endforeach
  </select>  
  </div>
	       
            <br>
            付款方式：
  <div class="form-group" id="paymethod"> 
  <select class="form-control" name="pay_mothod">
   
      <option value="网银">网银</option>
       <option value="柜台">柜台</option>
        <option value="pos">pos</option>
         <option value="转投">转投</option>
          <option value="续签">续签</option>
    
  </select>  
  </div>
           
 
            <br>
            付款日期
	     <input type="date" name="pay_date" class="form-control" required="required">
	        <div class="hidden" id="pay_time">
	  付款时间
            <input type="time" name="pay_time" class="form-control" >
           </div>
            <br>
               起息日期
            <input type="date" name="intrests_start_date" class="form-control" required="required">
            <br>
            成交金额(万元)
             <input type="text" name="deal_money" class="form-control" required="required">
            <br>
            年化收益
	      <input type="text" name="profit_byyear" class="form-control" required="required">
            <br>
            投资期限
            <div class="form-group" id="invest_time"> 
  <select class="form-control" name="invest_time">
   
      <option value="1">1个月</option>
       <option value="3">3个月</option>
        <option value="6">6个月</option>
         <option value="12">12个月</option>
 
    
  </select>  
  </div>
             
            <br>
            渠道提成(%)
	     <input type="text" name="channel_cut" class="form-control" required="required">
            <br>
             备注
	     <input type="text" name="other" class="form-control" required="required"  >
            <br>
            <button class="btn btn-lg btn-info">新增合同</button>
          </form>

        </div>
      </div>
    </div>
 </div>  
 <script>
  $( document.body ).on( 'click', '#paymethod', function( event ) {

       
      var $selectd= $("#paymethod option:selected").text();
      if ($selectd === 'pos'){
         $("#pay_time").removeClass("hidden");
        
          }
      else{
      	$("#pay_time").addClass("hidden");
      }
    

   });
</script>   
@stop
@section('bootor')
@stop
