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
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId, 'Sheet1!A:D');

		// Skip data row header
		if (!empty($users)) {
			array_shift($users);
		}

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
			$updateRange = 'Sheet1!A' . $row . ':N' . $row;

			$values = [
				[
					// Cell values ...
					'0' => (int) $userId,
					'1' => $inputs["name"],
					'2' => $inputs["address"],
					'3' => $inputs["phone"],
					'4' => $currentUser['1'],
					'5' => date('d/m/Y H:i:s', time()),
//					'6' => "", //$inputs["kham_tim"],
//					'7' => "", //$inputs["kham_mat"],
//					'8' => !empty($inputs['tab'][1]) ? json_encode($inputs['tab'][1]) : '',
//					'9' => ($lockDay1) ? 1 : 0,
//					'10' => !empty($inputs['tab'][2]) ? json_encode($inputs['tab'][2]) : '',
//					'11' => ($lockDay2) ? 1 : 0,
//					'12' => !empty($inputs['tab'][3]) ? json_encode($inputs['tab'][3]) : '',
//					'13' => ($lockDay3) ? 1 : 0,
//					'14' => !empty($inputs['tab'][4]) ? json_encode($inputs['tab'][4]) : '',
//					'15' => ($lockDay4) ? 1 : 0,
					'6' => !empty($inputs['tab'][1]) ? json_encode($inputs['tab'][1]) : '',
					'7' => ($lockDay1) ? 1 : 0,
					'8' => !empty($inputs['tab'][2]) ? json_encode($inputs['tab'][2]) : '',
					'9' => ($lockDay2) ? 1 : 0,
					'10' => !empty($inputs['tab'][3]) ? json_encode($inputs['tab'][3]) : '',
					'11' => ($lockDay3) ? 1 : 0,
					'12' => !empty($inputs['tab'][4]) ? json_encode($inputs['tab'][4]) : '',
					'13' => ($lockDay4) ? 1 : 0,
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
			$updateRange = 'Sheet1';
			$values = [
				[
					// Cell values ...
					'0' => (int) $nextId,
					'1' => $inputs["name"],
					'2' => $inputs["address"],
					'3' => $inputs["phone"],
					'4' => $currentUser['1'],
					'5' => date('d/m/Y H:i:s', time()),
//					'6' => "", //$inputs["kham_tim"],
//					'7' => "", //$inputs["kham_mat"],
//					'8' => !empty($inputs['tab'][1]) ? json_encode($inputs['tab'][1]) : "",
//					'9' => ($lockDay1) ? 1 : 0,
//					'10' => !empty($inputs['tab'][2]) ? json_encode($inputs['tab'][2]) : "",
//					'11' => ($lockDay2) ? 1 : 0,
//					'12' => !empty($inputs['tab'][3]) ? json_encode($inputs['tab'][3]) : "",
//					'13' => ($lockDay3) ? 1 : 0,
//					'14' => !empty($inputs['tab'][4]) ? json_encode($inputs['tab'][4]) : "",
//					'15' => ($lockDay4) ? 1 : 0,
					'6' => !empty($inputs['tab'][1]) ? json_encode($inputs['tab'][1]) : "",
					'7' => ($lockDay1) ? 1 : 0,
					'8' => !empty($inputs['tab'][2]) ? json_encode($inputs['tab'][2]) : "",
					'9' => ($lockDay2) ? 1 : 0,
					'10' => !empty($inputs['tab'][3]) ? json_encode($inputs['tab'][3]) : "",
					'11' => ($lockDay3) ? 1 : 0,
					'12' => !empty($inputs['tab'][4]) ? json_encode($inputs['tab'][4]) : "",
					'13' => ($lockDay4) ? 1 : 0,
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
		$currentUser = session('user');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId, 'Sheet1!A:A');

		// Check user exists
		$row = 0;
		foreach ($users as $key => $user) {
			if ($user[0] == $user_id) {
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
