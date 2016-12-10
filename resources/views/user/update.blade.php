@extends('layouts.default')

@section('content')
<div class="widget-box">
	<div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
		<h5>User Information</h5>
	</div>
	<div class="widget-content nopadding">
		<!--User form-->
		@include('user.elements.form')
	</div>
</div>
@stop

@section('script')
	<script src="{{ asset('js/user.form.js' . '?v=' . Config::get('version.js')) }}"></script>
@stop