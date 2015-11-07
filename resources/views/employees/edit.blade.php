@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">编辑员工信息</div>

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
	 <form action="{{ URL('employees/'.$employee->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             员工姓名  
            <input type="text" name="employee_name" class="form-control" required="required" value="{{ $employee->employee_name }}">
            <br>
            性别
             <input type="text" name="gender" class="form-control" required="required" value="{{ $employee->gender }}">
            <br>
          
            <button class="btn btn-lg btn-info">修改员工信息</button>
                       </form>
 

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop