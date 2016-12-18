@if ( UserHelper::checkExistLockTabs($user) && $loginUser[3] != 1 )
<div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading">Warning</h4>
	Complete tabs cannot be edited. If you want to edit, please contact with administrator.
</div>
@endif

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

<form class="form-horizontal" method="post" action="{{ route("user.save") }}" name="basic_validate" id="basic_validate">
	@if (isset($errors) && count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<div class="{{ !empty($user[0]) ? "span6" : "span12" }}">
		@if(!empty($user[0]))
		<div class="control-group">
			<label class="control-label">ID</label>
			<div class="controls">
				{!! Form::text("user_id", $user[0], ["id" => "user_id", "disabled" => "disabled"]) !!}
			</div>
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
				{!! Form::text("address", $user[2], ["id" => "address", "required" => ""]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Phone</label>
			<div class="controls">
				{!! Form::text("phone", $user[3], ["id" => "phone", "required" => ""]) !!}
			</div>
		</div>
	</div>

	@if(!empty($user[0]))
	<!-- Customer's QR Code -->
	<div class="span6">
		<div class="text-center">
			{!! QrCode::size(150)->generate(route('user.update', ['user_id' => $user[0]])); !!}
			<p>Scan me to return to customer info page.</p>
		</div>
	</div>
	@endif

	<!-- Tab -->
	<div class="widget-box" style="border-left: 0px; border-right: 0px;">
		<div class="widget-title">
			<ul class="nav nav-tabs">
				<li class="{{ empty($user[0]) || empty($user[7]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab1">Tab 1</a></li>
				<li class="{{ !empty($user[7]) && empty($user[9]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab2">Tab 2</a></li>
				<li class="{{ !empty($user[9]) && empty($user[11]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab3">Tab 3</a></li>
				<li class="{{ !empty($user[11]) && empty($user[13]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab4">Tab 4</a></li>
			</ul>
		</div>
		<div class="widget-content tab-content">
			<div id="tab1" class="tab-pane {{ empty($user[0]) || empty($user[7]) ? "active" : ""  }}">
				@include('user.elements.form_tab1')
			</div>
			<div id="tab2" class="tab-pane {{ !empty($user[7]) && empty($user[9]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '2'])
			</div>
			<div id="tab3" class="tab-pane {{ !empty($user[9]) && empty($user[11]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '3'])
			</div>
			<div id="tab4" class="tab-pane {{ !empty($user[11]) && empty($user[13]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '4'])
			</div>
		</div>
	</div>


	<div class="form-actions">
		<input type="hidden" value="{{ $user[0] }}" name="user_id" id="user_id">
		<input type="submit" value="Save" class="btn btn-success">
	</div>
</form>