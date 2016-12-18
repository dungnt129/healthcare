<?php
$index = 0;
switch($tab) {
	case 2:
		$index = 8;
		break;
	case 3:
		$index = 10;
		break;
	case 4:
		$index = 12;
		break;
	default:
		break;
}

$isLock = (!empty($user[$index + 1]) && $loginUser[3] != 1);
?>

@if(!$isLock)
	@include('user.elements.form_tab234_active')
@else
	@include('user.elements.form_tab234_lock')
@endif