@if ( UserHelper::checkExistLockTabs($user) && $loginUser[3] != 1 )
<div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading">Lưu ý</h4>
	Form đã điền không thể chỉnh sửa. Nếu bạn muốn sửa, xin hãy liên hệ quản lý.
</div>
@endif

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
				{!! Form::text("user_id", str_pad($user[0], 3, "0", STR_PAD_LEFT), ["id" => "user_id", "disabled" => "disabled"]) !!}
			</div>
		</div>
		@endif
        <div class="control-group">
			<label class="control-label">Mã UIC của khách hàng</label>
			<div class="controls">
				{!! Form::text("tab[1][tuvanvien3][maBenhNhan]", $user[11]["tuvanvien3"]["maBenhNhan"], ["id" => "tab[1][tuvanvien3][maBenhNhan]"]) !!}
			</div>
		</div>
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
			<label class="control-label">Link ảnh khách hàng</label>
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
            <img src="{{ $user[8] }}" alt="User Image" class="user-image"/>
			<p>Ảnh khách hàng.</p>
		</div>
		@endif
	</div>
	@endif

	<!-- Tab -->
	<div class="widget-box" style="border-left: 0px; border-right: 0px;">
		<div class="widget-title">
			<ul class="nav nav-tabs">
				<li id="li-tab1" class="{{ empty($user[0]) || empty($user[12]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab1">Cuộc hẹn đầu tiên</a></li>
				<li id="li-tab2" class="li-tab @if(!empty($isDisableOtherTabs)) hide @endif  {{ !empty($user[12]) && empty($user[14]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab2">Tháng thứ 1</a></li>
				<li id="li-tab3" class="li-tab @if(!empty($isDisableOtherTabs)) hide @endif {{ !empty($user[14]) && empty($user[16]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab3">Tháng thứ 3</a></li>
				<li id="li-tab4" class="li-tab @if(!empty($isDisableOtherTabs)) hide @endif {{ !empty($user[16]) && empty($user[18]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab4">Tháng thứ 6</a></li>
				<li id="li-tab5" class="li-tab @if(!empty($isDisableOtherTabs)) hide @endif {{ !empty($user[18]) && empty($user[20]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab5">Tháng thứ 9</a></li>
				<li id="li-tab6" class="li-tab @if(!empty($isDisableOtherTabs)) hide @endif {{ !empty($user[20]) && empty($user[22]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab6">Tháng thứ 12</a></li>
				<li id="li-tab7" class="li-tab @if(!empty($isDisableOtherTabs)) hide @endif {{ !empty($user[22]) && empty($user[24]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab7">Tháng thứ 15</a></li>
				<li id="li-tab8" class="li-tab @if(!empty($isDisableOtherTabs)) hide @endif {{ !empty($user[24]) && empty($user[26]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab8">Tháng thứ 18</a></li>
				<li id="li-tab9" class="li-tab @if(!empty($isDisableOtherTabs)) hide @endif {{ !empty($user[26]) && empty($user[27]) ? "active" : ""  }}"><a data-toggle="tab" href="#tab9">Các cuộc hẹn khác</a></li>
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