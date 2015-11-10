@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>
<th>员工姓名</th>
<th>性别</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($employees as $employee)
<tr>
<td>{{ $employee->employee_name}}</td>
<td>{{ $employee->gender }}</td>
<td><a href="{{ URL::route('employees.edit', $employee->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('employees/'.$employee->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete" data-title="删除" data-message="确认要删除此数据吗 ?">删除</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
{!! $employees->render() !!}
 
 <a href="{{ URL::route('employees.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 
 </div>
 @include('delconfirm')     
@stop
@section('bootor')
@stop