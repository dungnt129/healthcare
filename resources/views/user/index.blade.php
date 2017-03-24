@extends('layouts.default')

@section('content')
<div class="row-fluid">
	<a href="{{ route('user.create') }}" class="btn btn-info btn-xs" title="Edit">
		<i class="icon-plus"></i>
		Tạo khách hàng mới
	</a>
</div>

@if ( session()->has('success_message') )
<div class="alert alert-success alert-block">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading">Thành công!</h4>
	{{ session()->get('success_message') }}
</div>
@endif

@if ( session()->has('fail_message') )
<div class="alert alert-error alert-block">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading">Có lỗi xảy ra!</h4>
	{{ session()->get('fail_message') }}
</div>
@endif
<div class="widget-box">
	<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Data table</h5>
	</div>
	<div class="widget-content nopadding">
		@if(!empty($users))
		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Phone</th>
					<th>Mã BN</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $key => $user)
				<tr>
					<td>{!! !empty($user[0]) ? nl2br($user[0]) : '' !!}</td>
					<td>
						<a href="{{ route('user.update', ['user_id' => $user[0]]) }}">
							{!! !empty($user[1]) ? nl2br($user[1]) : '' !!}
						</a>
					</td>
					<td>{!! !empty($user[2]) ? nl2br($user[2]) : '' !!}</td>
					<td>{!! !empty($user[3]) ? nl2br($user[3]) : '' !!}</td>
					<td>{!! $user[4] or ''  !!}</td>
					<td class="text-center">
						<a href="{{ route('user.update', ['user_id' => $user[0]]) }}" class="btn btn-info btn-xs" title="Edit"><i class="icon-edit"></i></a>
						<a data-href="{{ route('user.delete', ['user_id' => $user[0]]) }}" class="btn btn-danger btn-xs btn-confirm-delete" title="Delete" data-toggle="modal"><i class="icon-remove"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>

	@include('user.elements.confirm_dialog')
</div>
@stop