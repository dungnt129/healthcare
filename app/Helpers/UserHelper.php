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

	static $mapOptionDay1 = [
		"tuvanvien1" => [
			"accept" => [
				1 => "Có"
			],
			"sex" => [
				1 => "Nam",
				2 => "Chuyển giới"
			],
			"isVietnamese" => [
				1 => "Có",
				2 => "Không"
			],
			"hasHIVfriend" => [
				1 => "Có",
				2 => "Không",
				3 => "Không biết",
				4 => "Không phù hợp"
			],
			"hasSexForCash" => [
				1 => "Có",
				2 => "Không",
				3 => "Không trả lời"
			],
			"hasGiangMaiInLastYear" => [
				1 => "Có",
				2 => "Không",
				3 => "Không trả lời"
			],
			"hasLauInLastYear" => [
				1 => "Có",
				2 => "Không",
				3 => "Không trả lời"
			],
			"hasChlamydiaInLastYear" => [
				1 => "Có",
				2 => "Không",
				3 => "Không trả lời"
			],
			"hasCondomWhenAssSex" => [
				1 => "Có",
				2 => "Không"
			],
			"hasAlwaysUseCondomWhenAssSex" => [
				1 => "Luôn luôn",
				2 => "Thường xuyên",
				3 => "Không bao giờ"
			],
			"hasCocainInLastYear" => [
				1 => "Có",
				2 => "Không",
				3 => "Không trả lời"
			],
			"hasPaidForPrEP" => [
				1 => "Có",
				2 => "Không",
				3 => "Không biết"
			],
			"howDoYouKnowPrep" => [
				1 => "Nhân viên xét nghiệm không chuyên",
				2 => "Tự đến (có thông tin qua chiến dịch và website của CARMAH)",
				3 => "CBO giới thiệu đến"
			]
		],
		"tuvanvien3" => [
			"accept_prep" => [
				1 => "Có"
			]
		]
	];

	static $mapOptionDay234 = [
		"tuvanvien1" => [
			"hasCondomWhenAssSex" => [
				1 => "Có",
				2 => "Không"
			],
			"hasAlwaysUseCondomWhenAssSex" => [
				1 => "Luôn luôn",
				2 => "Thường xuyên",
				3 => "Không bao giờ"
			],
			"hasCocainInLastYear" => [
				1 => "Có",
				2 => "Không",
				3 => "Không trả lời"
			]
		],
		"tuvanvien3" => [
			"hasHIV" => [
				1 => "Có",
				2 => "Không"
			],
			"otherReason" => [
				1 => "Tác dụng phụ của thuốc",
				2 => "Thay đổi nguy cơ"
			]
		]
	];

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
		$googleSheetHelper = GoogleSheet::getInstance();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId, 'Sheet1!A3:N');

		if(empty($users)) return $user;

		foreach($users as $data) {
			// Compare with user id
			if($data[0] == $userId) {
				// Decode json data day 1
				if(!empty($data[6])) {
					$data[6] = json_decode($data[6], true);
				}
				// Decode json data day 2
				if(!empty($data[8])) {
					$data[8] = json_decode($data[8], true);
				}
				// Decode json data day 3
				if(!empty($data[10])) {
					$data[10] = json_decode($data[10], true);
				}
				// Decode json data day 4
				if(!empty($data[12])) {
					$data[12] = json_decode($data[12], true);
				}

				return $data;
			}
		}

		return $user;
	}

	public static function getNextUserId() {
		$nextUserId = 1;

		// Init
		$googleSheetHelper = GoogleSheet::getInstance();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get next user id in user sheet data
		$data = $googleSheetHelper->getSpreadSheetData($userSheetId, 'Sheet1!GA2');

		if(empty($data[0][0])) return $nextUserId;

		return $data[0][0];
	}

	public static function getUpdateRowByUserId($userId) {
		$updateRow = 0;

		// Init
		$googleSheetHelper = GoogleSheet::getInstance();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId, 'Sheet1!A:A');

		// Calculate update row
		foreach($users as $key => $data) {
			// Compare with user id
			if(!empty($data[0]) && $data[0] == $userId) {
				$updateRow = $key + 1;
			}
		}

		return $updateRow;
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

	public static function checkExistLockTabs($user) {
		$result = false;

		if(empty($user)) return $result;

		return (!empty($user[7]) || !empty($user[9]) || !empty($user[11]) || !empty($user[13]));
	}

	public static function getShowDataDay1($data, $group, $key) {
		$value = (isset($data[$group][$key])) ? $data[$group][$key] : "";

		if(empty($data)) return $value;

		if(isset(self::$mapOptionDay1[$group][$key][$value])) {
			return self::$mapOptionDay1[$group][$key][$value];
		}

		return $value;
	}

	public static function getShowDataDay234($data, $group, $key) {
		$value = (isset($data[$group][$key])) ? $data[$group][$key] : "";

		if(empty($data)) return $value;

		if(isset(self::$mapOptionDay234[$group][$key][$value])) {
			return self::$mapOptionDay234[$group][$key][$value];
		}

		return $value;
	}
}