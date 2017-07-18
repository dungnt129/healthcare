@extends('layouts.default')

@section('content')
<div class="widget-box">
	<div class="widget-title"> <span class="icon"><i class="icon-group"></i></span>
		<h5>Thông tin khách hàng</h5>
	</div>
	<div class="widget-content nopadding">
		<!--User form-->
		@include('user.elements.form')
	</div>
</div>
@stop

@section('style')
<link href="{{ asset('css/zoomify.min.css' . '?v=' . Config::get('version.css')) }}" rel="stylesheet" />
@stop

@section('script')
<script src="{{ asset('js/zoomify.min.js' . '?v=' . Config::get('version.js')) }}"></script>
<script src="{{ asset('js/user.form.js' . '?v=' . Config::get('version.js')) }}"></script>
@stop
