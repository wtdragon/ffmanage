@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">编辑职位信息</div>

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
	 <form action="{{ URL('positions/'.$position->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            职称
            <input type="text" name="position_name" class="form-control" required="required" value="{{ $position->position_name }}">
            <br>
            部门编码
             <input type="text" name="department_id" class="form-control" required="required" value="{{ $position->department_id }}">
            <br>
            部门名称
	      <input type="text" name="department_name" class="form-control" required="required" value="{{ $position->department_name }}">
            <br>
            开始日期
	      <input type="date" name="start_date" class="form-control" required="required" value="{{ $position->start_date }}">
            <br>
            结束日期
	     <input type="date" name="end_date" class="form-control" required="required" value="{{ $position->end_date }}">
            <br>
            员工编码
	      <input type="text" name="employee_id" class="form-control" required="required" value="{{ $position->employee_id }}">
            <br>
            直接领导编码
	     <input type="text" name="leader_id" class="form-control" required="required" value="{{ $position->leader_id }}">
             <br>
                               层次
	      <input type="text" name="depth" class="form-control" required="required" value="{{ $position->depth }}">
            <button class="btn btn-lg btn-info">编辑职位信息</button>
                       </form>
 
 

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop
