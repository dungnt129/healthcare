<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Credential file location
    |--------------------------------------------------------------------------
    |
    | This is the location of the .json file from the Laravel root directory
    |
    */
    'credential_file_location' => storage_path() . '/google/healthcare.json',

	/*
    |--------------------------------------------------------------------------
    | Login Data Sheet
    |--------------------------------------------------------------------------
    |
    | This is ID of login data sheet
	| Ex: https://docs.google.com/spreadsheets/d/11hyCPHN2ryHVsZnmK3zlRmYcdiVSWabuFpsaNHptT2k/edit#gid=0
    |
    */
	'login_data_sheet' => '11hyCPHN2ryHVsZnmK3zlRmYcdiVSWabuFpsaNHptT2k',

	/*
    |--------------------------------------------------------------------------
    | User Data Sheet
    |--------------------------------------------------------------------------
    |
    | This is ID of user data sheet
	| Ex: https://docs.google.com/spreadsheets/d/1h6vG5o51AtNP1cz8BlmKhW78XDCeadM1A0LfyEV1EQw/edit#gid=0
    |
    */
	'user_data_sheet' => '1h6vG5o51AtNP1cz8BlmKhW78XDCeadM1A0LfyEV1EQw',
];