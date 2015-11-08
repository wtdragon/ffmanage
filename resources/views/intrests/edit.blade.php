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
                            实际分红日期
	      <input type="date" name="realinterest_date" class="form-control" required="required" value="{{ $interest->realinterest_date }}">
            <br>
           	是否已结息
           <div class="form-group" id="paymethod"> 
          
  <select class="form-control" name="have_intrests">
   
     
       <option value="0">否</option> 
        <option value="1">是</option>
    
  </select>  
  </div>
  <br>
  备注：
<input type="text" name="other" class="form-control" value="{{ $interest->other }}">
                  <br>
                    <button class="btn btn-lg btn-info">修改实际分红日期</button>
                       </form>
 

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop