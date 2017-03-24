<?php
$index = 0;
switch($tab) {
	case 2:
		$index = 13;
		break;
	case 3:
		$index = 15;
		break;
	case 4:
		$index = 17;
		break;
	case 5:
		$index = 19;
		break;
	case 6:
		$index = 21;
		break;
	case 7:
		$index = 23;
		break;
	case 8:
		$index = 25;
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