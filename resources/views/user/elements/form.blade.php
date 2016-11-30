@if ( session()->has('success_message') )
<div class="alert alert-success alert-block">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading">Success!</h4>
	{{ session()->get('success_message') }}
</div>
@endif

@if ( session()->has('fail_message') )
<div class="alert alert-error alert-block">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading">Error!</h4>
	{{ session()->get('fail_message') }}
</div>
@endif

<form class="form-horizontal" method="post" action="{{ route("user.save") }}" name="basic_validate" id="basic_validate" novalidate="novalidate">
	@if (isset($errors) && count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="control-group">
		<label class="control-label">Name</label>
		<div class="controls">
			{!! Form::text("name", $user[1], ["id" => "name", "required" => ""]) !!}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Address</label>
		<div class="controls">
			{!! Form::text("address", $user[2], ["id" => "address"]) !!}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Phone</label>
		<div class="controls">
			{!! Form::text("phone", $user[3], ["id" => "phone"]) !!}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Khám tim</label>
		<div class="controls">
			{!! Form::textarea ("kham_tim", $user[6], ["id" => "kham_tim", "class" => "span6", "cols" => "5", "rows" => "5"]) !!}
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Khám mắt</label>
		<div class="controls">
			{!! Form::textarea ("kham_mat", $user[7], ["id" => "kham_mat", "class" => "span6", "cols" => "5", "rows" => "5"]) !!}
		</div>
	</div>
	<div class="form-actions">
		<input type="hidden" value="{{ $user[0] }}" name="user_id" id="user_id">
		<input type="submit" value="Save" class="btn btn-success">
	</div>
</form>