@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>
<th>职称编码</th>	
<th>职称</th>
<th>部门编码</th>
<th>部门名称</th>
<th>开始日期</th>
<th>结束日期</th>
<th>员工姓名</th>
<th>直接领导</th>
<th>分支名称</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
 @foreach ($positions as $position)
<tr>
<td>{{ $position->id}}</td>	
<td>{{ $position->position_name}}</td>
<td>{{ $position->department_id }}</td>
<td>{{ $position->department_name}}</td>
<td>{{ $position->start_date }}</td>
<td>{{ $position->end_date}}</td>
<td>{{ $position->employee->employee_name }}</td>
<td>{{ $position->leader->employee_name}}</td>
<td>{{ $position->branch_name}}</td>
<td><a href="{{ URL::route('positions.edit', $position->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('positions/'.$position->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger">删除</button>
            </form>
</td>
</tr>
@endforeach
</tbody>
</table>
<a href="{{ URL::route('positions.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 
 </div>  
@stop
@section('bootor')
@stop
