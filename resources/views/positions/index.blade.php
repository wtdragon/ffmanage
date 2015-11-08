@extends('master')
@section('header')
@stop
@section('content')
<div class="center" >
<table class="table table-bordered">
<thead>
<tr>	
<th>职称</th>
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
<td>{{ $position->position_name}}</td>
<td>{{ $position->department_name}}</td>
<td>{{ $position->start_date }}</td>
<td>{{ $position->end_date}}</td>
<td>{{ $position->employee->employee_name}}</td>
@if ($position->leader_id === 0)
<td>{{ $position->employee->employee_name}}</td>
<td>{{ $position->branch_name}}</td>
  
@else 
	<td>{{ $position->leader->employee_name}}</td>
<td>{{ $position->branch_name}}</td>
<td><a href="{{ URL::route('positions.edit', $position->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
<form action="{{ URL('positions/'.$position->id) }}" method="POST" style="display: inline;">
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete" data-title="删除" data-message="确认要删除此数据吗 ?">删除</button>
</form>
</td>
 
@endif

</tr>
@endforeach
</tbody>
</table>
<a href="{{ URL::route('positions.create' ) }}" class="btn btn-success btn-mini pull-left">新增</a>
 
 </div>  
 @include('delconfirm')   
@stop
@section('bootor')
@stop
