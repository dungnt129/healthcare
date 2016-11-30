<?php
namespace App\Helpers;

use Cache;
use Config;
use App\Helpers\GoogleSheet;

/**
 *
 * User Helper Class
 *
 * @todo process user data
 * @author DungNT
 *
 */
class UserHelper {

	/**
	 * Get Login User Info
	 *
	 * @return array
	 */
	public static function getLoginUserInfo() {
		return session('user');
	}

	public static function getLoginUserName() {
		$username = '';

		// Get user info
		$user = session('user');

		if(!empty($user)) {
			return $user[1];
		}

		return $username;
	}

	public static function getUserInfoById($userId) {
		$user = [];

		// Init
		$googleSheetHelper = new GoogleSheet();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId);

		if(empty($users)) return $user;

		// Skip data row header
		array_shift($users);

		foreach($users as $data) {
			// Compare with user id
			if($data[0] == $userId) {
				return $data;
			}
		}

		return $user;
	}

	public static function getLastUserId() {
		$lastUserId = 0;

		// Init
		$googleSheetHelper = new GoogleSheet();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId);

		// Skip data row header
		array_shift($users);

		foreach($users as $data) {
			// Compare with user id
			if($data[0] > $lastUserId && is_numeric($data[0])) {
				$lastUserId = $data[0];
			}
		}

		return $lastUserId;
	}

	public static function getUpdateRowByUserId($userId) {
		$updateRow = 0;

		// Init
		$googleSheetHelper = new GoogleSheet();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId);

		// Calculate update row
		foreach($users as $key => $data) {
			// Compare with user id
			if($data[0] == $userId && is_numeric($data[0])) {
				$updateRow = $key + 1;
			}
		}

		return $updateRow;
	}
}