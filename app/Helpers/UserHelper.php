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
				// Decode json data day 1
				if(!empty($data[8])) {
					$data[8] = json_decode($data[8], true);
				}
				// Decode json data day 2
				if(!empty($data[10])) {
					$data[10] = json_decode($data[10], true);
				}
				// Decode json data day 3
				if(!empty($data[12])) {
					$data[12] = json_decode($data[12], true);
				}
				// Decode json data day 4
				if(!empty($data[14])) {
					$data[14] = json_decode($data[14], true);
				}

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
		$user = [];

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
				$user = $data;
			}
		}

		return [$updateRow, $user];
	}

	public static function checkInputCompleteTab1($data) {
		$result = false;

		if(empty($data['tab'][1])) return $result;

		$tuvanvien1 = $data['tab'][1]['tuvanvien1'];
		$bacsi = $data['tab'][1]['bacsi'];
		$tuvanvien3 = $data['tab'][1]['tuvanvien3'];

		$arrDataTuvanvien1Required = [
			"tentuvanvien", "date", "accept", "birthyear", "sex", "isVietnamese", "hasHIVfriend",
			"hasSexForCash", "hasGiangMaiInLastYear", "hasLauInLastYear", "hasChlamydiaInLastYear",
			"hasCocainInLastYear", "hasPaidForPrEP"
		];

		$arrDataBacsiRequired = [
			"tenbacsi", "date", "fastHIVresult", "fastHIVresultdate", "confirmHIVresult", "confirmHIVresultdate",
			"viemGanBresult", "viemGanBresultdate", "sangLocViemGanBresult", "sangLocViemGanBresultdate","antiHBsresult",
			"antiHBsresultdate", "antiHCVresult", "antiHCVresultdate", "antiHAVresult", "antiHAVresultdate", "giangmaiResult",
			"giangmaiResultDate", "chucnangthanResult", "chucnangthanResultDate"
		];

		$arrDataTuvanvien3Required = [
			"tentuvanvien", "date", "accept_prep", "maBenhNhan"
		];

		// Check data
		foreach($arrDataTuvanvien1Required as $field) {
			if(empty($tuvanvien1[$field]))
				return $result;
		}

		foreach($arrDataBacsiRequired as $field) {
			if(empty($bacsi[$field]))
				return $result;
		}

		foreach($arrDataTuvanvien3Required as $field) {
			if(empty($tuvanvien3[$field]))
				return $result;
		}

		return true;
	}

	public static function checkInputCompleteTab234($data, $tab) {
		$result = false;

		if(empty($data['tab'][$tab])) return $result;

		$tuvanvien1 = $data['tab'][$tab]['tuvanvien1'];
		$bacsi = $data['tab'][$tab]['bacsi'];
		$tuvanvien3 = $data['tab'][$tab]['tuvanvien3'];

		$arrDataTuvanvien1Required = [
			"tentuvanvien", "date", "report_number", "real_number", "hasTieuChay", "hasTired", "hasPoisonGan",
			"hasChangedEmotion", "hasBuonNon", "hasManNgua", "hasNonMua", "hasCocainInLastYear"
		];

		$arrDataBacsiRequired = [
			"tenbacsi", "date", "fastHIVresult", "fastHIVresultdate", "confirmHIVresult", "confirmHIVresultdate",
			"chucnangthanResult", "chucnangthanResultDate", "hasSideEffects", "antiHCVresult", "antiHCVresultdate",
			"VDRLRPRresult", "VDRLRPRresultdate", "poisonGanResult", "poisonGanResultDate"
		];

//		$arrDataTuvanvien3Required = [
//			"tentuvanvien", "date", "hasHIV"
//		];

		// Check data
		foreach($arrDataTuvanvien1Required as $field) {
			if(empty($tuvanvien1[$field]))
				return $result;
		}

		foreach($arrDataBacsiRequired as $field) {
			if(empty($bacsi[$field]))
				return $result;
		}

//		foreach($arrDataTuvanvien3Required as $field) {
//			if(empty($tuvanvien3[$field]))
//				return $result;
//		}

		return true;
	}
}