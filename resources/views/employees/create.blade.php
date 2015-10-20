@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">新增员工</div>

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

          <form action="{{ URL('employees') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            员工姓名  
            <input type="text" name="employee_name" class="form-control" required="required">
            <br>
            性别
             <input type="text" name="gender" class="form-control" required="required" >
            <br>
            职称编码
	      <input type="text" name="position_id" class="form-control" required="required" >
            <br>
            <button class="btn btn-lg btn-info">新增员工</button>
          </form>

        </div>
      </div>
    </div>
 </div>  
@stop
@section('bootor')
@stop