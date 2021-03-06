@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增职位</div>

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

          <form action="{{ URL('positions') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             职称：
  <div class="form-group" id="paymethod"> 
  <select class="form-control" name="position_name"  required="required">
   
      <option value="副总经理">副总经理</option>
       <option value="总监">总监</option>
        <option value="销售经理">销售经理</option>
         <option value="销售专员">销售专员</option>
     
    
  </select>  
  </div>
              <br>
            部门名称
	      <input type="text" name="department_name" class="form-control" required="required">
            <br>
            开始日期
	      <input type="date" name="start_date" class="form-control" required="required">
            <br>
            结束日期
	     <input type="date" name="end_date" class="form-control" required="required">
            <br>
            员工姓名:
            <div class="form-group"> 
  <select class="form-control" name="employee_id">
  	@foreach($sales as $sale)
       <option value="{{$sale->id}}">{{$sale->employee_name}}</option>
    @endforeach
  </select>  
  </div>
           
            <br>
            直接领导:
            <div class="form-group"> 
  <select class="form-control" name="leader_id">
  	@foreach($leaders as $leader)
      <option value="{{$leader->leader_id}}">{{$leader->employee->employee_name}}</option>
    @endforeach
  </select>  
  </div>
	       
            <br>
            <button class="btn btn-lg btn-info">新增职位</button>
          </form>

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop
