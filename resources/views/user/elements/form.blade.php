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
			<label class="control-label">Mã số</label>
			<div class="controls">
				{!! Form::text("user_id", $user[0], ["id" => "user_id", "disabled" => "disabled"]) !!}
			</div>
		</div>
		@endif
		<div class="control-group">
			<label class="control-label">Tên khách hàng</label>
			<div class="controls">
				{!! Form::text("name", $user[1], ["id" => "name"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Địa chỉ</label>
			<div class="controls">
				{!! Form::text("address", $user[2], ["id" => "address"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Số điện thoại</label>
			<div class="controls">
				{!! Form::text("phone", $user[3], ["id" => "phone"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Email</label>
			<div class="controls">
				{!! Form::text("email", $user[5], ["id" => "email"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Zalo</label>
			<div class="controls">
				{!! Form::text("zalo", $user[6], ["id" => "zalo"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Facebook</label>
			<div class="controls">
				{!! Form::text("facebook", $user[7], ["id" => "facebook"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Image URL</label>
			<div class="controls">
				{!! Form::url("image_url", $user[8], ["id" => "image_url"]) !!}
			</div>
		</div>
		<div class="form-actions">
			<input value="Lưu" class="btn btn-success" type="submit">
		</div>
	</div>

	@if(!empty($user[0]))
	<!-- Customer's QR Code -->
	<div class="span6">
		<div class="text-center">
			{!! QrCode::size(150)->generate(route('user.update', ['user_id' => $user[0]])); !!}
			<p>Scan me to return to customer info page.</p>
		</div>
		@if(!empty($user[8]))
		<div class="text-center square">
			<img src="{{ $user[8] }}" alt="User Image"/>
			<p>User Image.</p>
		</div>
		@endif
	</div>
	@endif

	<!-- Tab -->
	<div class="widget-box" style="border-left: 0px; border-right: 0px;">
		<div class="widget-title">
			<ul class="nav nav-tabs">
				<li class="{{ empty($user[0]) || empty($user[12]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab1">1st Visit</a></li>
				<li class="{{ !empty($user[12]) && empty($user[14]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab2">2nd Visit</a></li>
				<li class="{{ !empty($user[14]) && empty($user[16]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab3">3rd Visit</a></li>
				<li class="{{ !empty($user[16]) && empty($user[18]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab4">4th Visit</a></li>
				<li class="{{ !empty($user[18]) && empty($user[20]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab5">5th Visit</a></li>
				<li class="{{ !empty($user[20]) && empty($user[22]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab6">6th Visit</a></li>
				<li class="{{ !empty($user[22]) && empty($user[24]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab7">7th Visit</a></li>
				<li class="{{ !empty($user[24]) && empty($user[26]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab8">8th Visit</a></li>
				<li class="{{ !empty($user[26]) && empty($user[27]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab9">9th Visit</a></li>
			</ul>
		</div>
		<div class="widget-content tab-content">
			<div id="tab1" class="tab-pane {{ empty($user[0]) || empty($user[12]) ? "active" : ""  }}">
				@include('user.elements.form_tab1')
			</div>
			<div id="tab2" class="tab-pane {{ !empty($user[12]) && empty($user[14]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '2'])
			</div>
			<div id="tab3" class="tab-pane {{ !empty($user[14]) && empty($user[16]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '3'])
			</div>
			<div id="tab4" class="tab-pane {{ !empty($user[16]) && empty($user[18]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '4'])
			</div>
			<div id="tab5" class="tab-pane {{ !empty($user[18]) && empty($user[20]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '5'])
			</div>
			<div id="tab6" class="tab-pane {{ !empty($user[20]) && empty($user[22]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '6'])
			</div>
			<div id="tab7" class="tab-pane {{ !empty($user[22]) && empty($user[24]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '7'])
			</div>
			<div id="tab8" class="tab-pane {{ !empty($user[24]) && empty($user[26]) ? "active" : ""  }}">
				@include('user.elements.form_tab234', ['tab' => '8'])
			</div>
			<div id="tab9" class="tab-pane {{ !empty($user[26]) && empty($user[27]) ? "active" : ""  }}">
				@include('user.elements.form_tab9')
			</div>
		</div>
	</div>


	<div class="form-actions">
		<input type="hidden" value="{{ $user[0] }}" name="user_id" id="user_id">
		<input type="submit" value="Lưu" class="btn btn-success">
	</div>
</form>