<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleSheet;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use Validator;
use Config;
use Log;

/**
 *
 * User Controller
 *
 * @todo Manage user data
 * @author DungNT
 *
 */
class UserController extends Controller {
	/*
	  |--------------------------------------------------------------------------
	  | User List
	  |--------------------------------------------------------------------------
	  |
	  | Show user list
	  |
	 */

	public function index() {
		// Init
		$googleSheetHelper = GoogleSheet::getInstance();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId, 'Sheet1!A3:D');

		return view('user.index', [
			'users' => $users,
			'pageTitle' => 'List Users',
		]);
	}

	/*
	  |--------------------------------------------------------------------------
	  | User Detail
	  |--------------------------------------------------------------------------
	  |
	  | Show user detail
	  |
	 */

	public function detail($user_id) {
		// Get user info from session
		$user = session('user');

		// Check user_id in session and url & user is not admin
		if ($user[0] != $user_id && $user[3] != 1) {
			return view('errors.403');
		}

		// Get full user info from google sheet
		$user = UserHelper::getUserInfoById($user_id);

		return view('user.detail', ['user' => $user]);
	}

	/*
	  |--------------------------------------------------------------------------
	  | Create User
	  |--------------------------------------------------------------------------
	  |
	  | Display form create user
	  |
	 */

	public function create() {
		$loginUser = session('user');

		// Default user info
		$user = $this->_initNewUser();

		return view('user.create', [
			'user' => $user,
			'loginUser' => $loginUser,
			'pageTitle' => 'Create User',
		]);
	}

	/*
	  |--------------------------------------------------------------------------
	  | Update User
	  |--------------------------------------------------------------------------
	  |
	  | Display form update user
	  |
	 */

	public function update($user_id) {
		$loginUser = session('user');

		// Get user info
		$user = UserHelper::getUserInfoById($user_id);

		if (empty($user)) {
			return redirect()->route('user.list')->with('fail_message', 'User is not exist.');
		}

		return view('user.update', [
			'user' => $user,
			'loginUser' => $loginUser,
			'pageTitle' => 'Update User',
		]);
	}

	/*
	  |--------------------------------------------------------------------------
	  | Update User
	  |--------------------------------------------------------------------------
	  |
	  | Display form update user
	  |
	 */

	public function save(Request $request) {
		// Get user input
		$inputs = $request->all();

		$userId = !empty($inputs['user_id']) ? $inputs['user_id'] : '';

		// Validate
		$validator = Validator::make($inputs, [
					'name' => 'required',
					'address' => 'required',
					'phone' => 'required'
		]);

		if ($validator->fails()) {
			// Update
			if (!empty($userId)) {
				return redirect()->route('user.update', ['user_id' => $userId])
								->withErrors($validator)
								->withInput();
			}

			return redirect()->route('user.create')
							->withErrors($validator)
							->withInput();
		}

		// Init
		$googleSheetHelper = GoogleSheet::getInstance();
		$userSheetId = Config::get('google.user_data_sheet');

		$currentUser = session('user');

		// Check lock
		$lockDay1 = UserHelper::checkInputCompleteTab1($inputs);
		$lockDay2 = UserHelper::checkInputCompleteTab234($inputs, 2);
		$lockDay3 = UserHelper::checkInputCompleteTab234($inputs, 3);
		$lockDay4 = UserHelper::checkInputCompleteTab234($inputs, 4);

		$dataTab1 = !empty($inputs['tab'][1]) ? $inputs['tab'][1] : "";
		$dataTab2 = !empty($inputs['tab'][2]) ? $inputs['tab'][2] : "";
		$dataTab3 = !empty($inputs['tab'][3]) ? $inputs['tab'][3] : "";
		$dataTab4 = !empty($inputs['tab'][4]) ? $inputs['tab'][4] : "";

		$dataTab1Encode = !empty($inputs['tab'][1]) ? json_encode($inputs['tab'][1]) : "";
		$dataTab2Encode = !empty($inputs['tab'][2]) ? json_encode($inputs['tab'][2]) : "";
		$dataTab3Encode = !empty($inputs['tab'][3]) ? json_encode($inputs['tab'][3]) : "";
		$dataTab4Encode = !empty($inputs['tab'][4]) ? json_encode($inputs['tab'][4]) : "";

		// Update
		if (!empty($userId)) {
			// Get updating row
			$row = UserHelper::getUpdateRowByUserId($userId);

			if (empty($row)) {
				return redirect()->route('user.update', ['user_id' => $userId])
								->with('fail_message', 'System error.User information cannot be saved.')
								->withInput();
			}

			// Update data
			$updateRange = 'Sheet1!A' . $row . ':BJ' . $row;

			$values = [
				[
					// Cell values ...
					'0' => (int) $userId,
					'1' => $inputs["name"],
					'2' => $inputs["address"],
					'3' => $inputs["phone"],
					'4' => $currentUser['1'],
					'5' => date('d/m/Y H:i:s', time()),
					'6' => $dataTab1Encode,
					'7' => ($lockDay1) ? 1 : 0,
					'8' => $dataTab2Encode,
					'9' => ($lockDay2) ? 1 : 0,
					'10' => $dataTab3Encode,
					'11' => ($lockDay3) ? 1 : 0,
					'12' => $dataTab4Encode,
					'13' => ($lockDay4) ? 1 : 0,
					'14' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "tentuvanvien"),
					'15' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "date"),
					'16' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "accept"),
					'17' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "birthyear"),
					'18' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "sex"),
					'19' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "isVietnamese"),
					'20' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasHIVfriend"),
					'21' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasSexForCash"),
					'22' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasGiangMaiInLastYear"),
					'23' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasLauInLastYear"),
					'24' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasChlamydiaInLastYear"),
					'25' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManySexFriends"),
					'26' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'27' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCondomWhenAssSex"),
					'28' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'29' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCocainInLastYear"),
					'30' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAnotherCocainLastYear"),
					'31' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasPaidForPrEP"),
					'32' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "email"),
					'33' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "mobile"),
					'34' => (!empty(UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep"))) ? UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep") : UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrepText"),
					'35' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "otherComment"),
					'36' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "tenbacsi"),
					'37' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "date"),
					'38' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresult"),
					'39' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresultdate"),
					'40' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresult"),
					'41' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresultdate"),
					'42' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "viemGanBresult"),
					'43' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "viemGanBresultdate"),
					'44' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresult"),
					'45' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresultdate"),
					'46' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresult"),
					'47' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresultdate"),
					'48' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresult"),
					'49' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresultdate"),
					'50' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresult"),
					'51' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresultdate"),
					'52' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResult"),
					'53' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResultDate"),
					'54' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResult"),
					'55' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResultDate"),
					'56' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "otherComment"),
					'57' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "tentuvanvien"),
					'58' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "date"),
					'59' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "accept_prep"),
					'60' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "maBenhNhan"),
					'61' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "otherComment"),
				]
			];

			// Update google sheet
			$result = $googleSheetHelper->updateRows($userSheetId, $updateRange, $values);

			// Error
			if (!$result) {
				return redirect()->route('user.update', ['user_id' => $userId])
								->with('fail_message', 'System error.User information cannot be saved.')
								->withInput();
			}

			// Log
			Log::info('Update Customer', ["Customer_Id" => $userId, "Update_Values" => $values, "Update_Range" => $updateRange, "Edited_By" => $currentUser]);
		} else {
			// Get next user id
			$nextId = UserHelper::getNextUserId();

			// Error
			if (!$nextId) {
				return redirect()->route('user.create')
								->with('fail_message', 'System error.User information cannot be saved.')
								->withInput();
			}

			// Insert data
			$updateRange = 'Sheet1!A:BJ';
			$values = [
				[
					// Cell values ...
					'0' => (int) $nextId,
					'1' => $inputs["name"],
					'2' => $inputs["address"],
					'3' => $inputs["phone"],
					'4' => $currentUser['1'],
					'5' => date('d/m/Y H:i:s', time()),
					'6' => $dataTab1Encode,
					'7' => ($lockDay1) ? 1 : 0,
					'8' => $dataTab2Encode,
					'9' => ($lockDay2) ? 1 : 0,
					'10' => $dataTab3Encode,
					'11' => ($lockDay3) ? 1 : 0,
					'12' => $dataTab4Encode,
					'13' => ($lockDay4) ? 1 : 0,
					'14' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "tentuvanvien"),
					'15' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "date"),
					'16' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "accept"),
					'17' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "birthyear"),
					'18' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "sex"),
					'19' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "isVietnamese"),
					'20' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasHIVfriend"),
					'21' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasSexForCash"),
					'22' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasGiangMaiInLastYear"),
					'23' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasLauInLastYear"),
					'24' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasChlamydiaInLastYear"),
					'25' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManySexFriends"),
					'26' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'27' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCondomWhenAssSex"),
					'28' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'29' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCocainInLastYear"),
					'30' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAnotherCocainLastYear"),
					'31' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasPaidForPrEP"),
					'32' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "email"),
					'33' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "mobile"),
					'34' => (!empty(UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep"))) ? UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep") : UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrepText"),
					'35' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "otherComment"),
					'36' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "tenbacsi"),
					'37' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "date"),
					'38' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresult"),
					'39' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresultdate"),
					'40' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresult"),
					'41' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresultdate"),
					'42' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "viemGanBresult"),
					'43' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "viemGanBresultdate"),
					'44' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresult"),
					'45' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresultdate"),
					'46' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresult"),
					'47' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresultdate"),
					'48' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresult"),
					'49' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresultdate"),
					'50' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresult"),
					'51' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresultdate"),
					'52' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResult"),
					'53' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResultDate"),
					'54' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResult"),
					'55' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResultDate"),
					'56' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "otherComment"),
					'57' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "tentuvanvien"),
					'58' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "date"),
					'59' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "accept_prep"),
					'60' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "maBenhNhan"),
					'61' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "otherComment"),
				]
			];

			$result = $googleSheetHelper->insertRows($userSheetId, $updateRange, $values);

			// Error
			if (!$result) {
				return redirect()->route('user.create')
								->with('fail_message', 'System error.User information cannot be saved.')
								->withInput();
			}
			// Log
			Log::info('Create Customer', ["Insert_Values" => $values, "Update_Range" => $updateRange, "Edited_By" => $currentUser]);

			// Set new user id to redirect
			$userId = $nextId;
		}

		// Success
		return redirect()->route('user.update', ['user_id' => $userId])->with('success_message', 'User information has been saved.');
	}

	/*
	  |--------------------------------------------------------------------------
	  | Delete User
	  |--------------------------------------------------------------------------
	  |
	  | Delete user in google sheet
	  |
	 */

	public function delete($user_id) {
		// Init
		$googleSheetHelper = GoogleSheet::getInstance();
		$userSheetId = Config::get('google.user_data_sheet');
		$headerRowNums = Config::get('google.user_data_sheet_header_rows_nums');
		$currentUser = session('user');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId, 'Sheet1!A:A');

		// Check user exists
		$row = 0;
		foreach ($users as $key => $user) {
			if (!empty($user[0]) && $user[0] == $user_id) {
				$row = $key;
			}
		}

		// Delete data
		if ($row) {
			$result = $googleSheetHelper->deleteRows($userSheetId, $row);

			// Error
			if (!$result) {
				return redirect()->route('user.list')->with('fail_message', 'System error.User cannot be deleted.');
			}
		} else {
			return redirect()->route('user.list')->with('fail_message', 'User id is not exist.');
		}

		// Log
		Log::info('Delete Customer', ["Customer_Id" => $user_id, "Deleted_By" => $currentUser]);

		// Success
		return redirect()->route('user.list')->with('success_message', 'User has been deleted.');
	}

	private function _initNewUser() {
		return [
			"", //ID
			"", //Name
			"", //Address
			"", //Phone
			"", //Last edited by
			"", //Last edited time
			[ // Tab 1
				"tuvanvien1" => [
					"tentuvanvien" => "",
					"date" => "",
					"accept" => "",
					"birthyear" => "",
					"sex" => "",
					"isVietnamese" => "",
					"hasHIVfriend" => "",
					"hasSexForCash" => "",
					"hasGiangMaiInLastYear" => "",
					"hasLauInLastYear" => "",
					"hasChlamydiaInLastYear" => "",
					"howManySexFriends" => "",
					"howManyAssSexFriends" => "",
					"hasCondomWhenAssSex" => "",
					"hasAlwaysUseCondomWhenAssSex" => "",
					"hasCocainInLastYear" => "",
					"hasAnotherCocainLastYear" => "",
					"hasPaidForPrEP" => "",
					"email" => "",
					"mobile" => "",
					"howDoYouKnowPrep" => "",
					"howDoYouKnowPrepText" => "",
					"otherComment" => "",
				],
				"bacsi" => [
					"tenbacsi" => "",
					"date" => "",
					"fastHIVresult" => "",
					"fastHIVresultdate" => "",
					"confirmHIVresult" => "",
					"confirmHIVresultdate" => "",
					"viemGanBresult" => "",
					"viemGanBresultdate" => "",
					"sangLocViemGanBresult" => "",
					"sangLocViemGanBresultdate" => "",
					"antiHBsresult" => "",
					"antiHBsresultdate" => "",
					"antiHCVresult" => "",
					"antiHCVresultdate" => "",
					"antiHAVresult" => "",
					"antiHAVresultdate" => "",
					"giangmaiResult" => "",
					"giangmaiResultDate" => "",
					"chucnangthanResult" => "",
					"chucnangthanResultDate" => "",
					"otherComment" => ""
				],
				"tuvanvien3" => [
					"tentuvanvien" => "",
					"date" => "",
					"accept_prep" => "",
					"maBenhNhan" => "",
					"otherComment" => ""
				]
			]
		];
	}

}
