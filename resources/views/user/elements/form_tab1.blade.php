<?php
$isLock = (!empty($user[9]) && $loginUser[3] != 1);
?>

@if(!$isLock)
	@include('user.elements.form_tab1_active')
@else
	@include('user.elements.form_tab1_lock')
@endif