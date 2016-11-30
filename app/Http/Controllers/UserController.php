<?php namespace App\Http\Controllers;

use App\Helpers\GoogleSheet;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use Validator;
use Config;

/**
 *
 * User Controller
 *
 * @todo Manage user data
 * @author DungNT
 *
 */
class UserController extends Controller
{
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
		$googleSheetHelper = new GoogleSheet();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId);

		// Skip data row header
		if(!empty($users)) {
			array_shift($users);
		}

		return view('user.index', [
			'users'				=> $users,
			'pageTitle'			=> 'List Users',
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
		if($user[0] != $user_id && $user[3] != 1) {
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
		// Default user info
		$user = $this->_initNewUser();

		return view('user.create', [
			'user'				=> $user,
			'pageTitle'			=> 'Create User',
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
		// Get user info
		$user = UserHelper::getUserInfoById($user_id);

		if(empty($user)) {
			return redirect()->route('user.list')->with('fail_message', 'User is not exist.');
		}

		return view('user.update', [
			'user'				=> $user,
			'pageTitle'			=> 'Update User',
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

		//dd($inputs, $userId);

		// Validate
		$validator = Validator::make($inputs, [
            'name' => 'required'
        ]);

		if ($validator->fails()) {
			// Update
			if(!empty($userId)) {
				return redirect()->route('user.update', ['user_id' => $userId])
                        ->withErrors($validator)
                        ->withInput();
			}

            return redirect()->route('user.create')
                        ->withErrors($validator)
                        ->withInput();
        }

		// Init
		$googleSheetHelper = new GoogleSheet();
		$userSheetId = Config::get('google.user_data_sheet');

		$currentUser = session('user');

		// Update
		if(!empty($userId)) {
			// Get updating row
			$row = UserHelper::getUpdateRowByUserId($userId);

			if(empty($row)) {
				return redirect()->route('user.update', ['user_id' => $userId])
						->with('fail_message', 'System error.User information cannot be saved.')
                        ->withInput();
			}

			// Update data
			$updateRange = 'Sheet1!A' . $row;
			$values = array(
				array(
					// Cell values ...
					'0' => (int) $userId,
					'1' => $inputs["name"],
					'2' => $inputs["address"],
					'3' => $inputs["phone"],
					'4' => $currentUser['1'],
					'5' => date('d/m/Y h:i:s', time()),
					'6' => $inputs["kham_tim"],
					'7' => $inputs["kham_mat"]
				)
			);

			// Update google sheet
			$result = $googleSheetHelper->updateRows($userSheetId, $updateRange, $values);

			// Error
			if(!$result) {
				return redirect()->route('user.update', ['user_id' => $userId])
						->with('fail_message', 'System error.User information cannot be saved.')
                        ->withInput();
			}


		} else {
			// Calculate new user id
			$lastUserId = UserHelper::getLastUserId();
			$lastUserId++;

			// Insert data
			$updateRange = 'Sheet1';
			$values = array(
				array(
					// Cell values ...
					'0' => (int) $lastUserId,
					'1' => $inputs["name"],
					'2' => $inputs["address"],
					'3' => $inputs["phone"],
					'4' => $currentUser['1'],
					'5' => date('d/m/Y h:i:s', time()),
					'6' => $inputs["kham_tim"],
					'7' => $inputs["kham_mat"]
				)
			);

			$result = $googleSheetHelper->insertRows($userSheetId, $updateRange, $values);

			// Error
			if(!$result) {
				return redirect()->route('user.create')
                        ->with('fail_message', 'System error.User information cannot be saved.')
                        ->withInput();
			}

			// Assign new user id
			$userId = $lastUserId;
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
		$googleSheetHelper = new GoogleSheet();
		$userSheetId = Config::get('google.user_data_sheet');

		// Get list user data from google sheet
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId);

		// Check user exists
		$row = 0;
		foreach($users as $key => $user) {
			if($user[0] == $user_id) {
				$row = $key;
			}
		}

		// Delete data
		if($row) {
			$result = $googleSheetHelper->deleteRows($userSheetId, $row);

			// Error
			if(!$result) {
				return redirect()->route('user.list')->with('fail_message', 'System error.User cannot be deleted.');
			}
		} else {
			return redirect()->route('user.list')->with('fail_message', 'User id is not exist.');
		}

		// Success
		return redirect()->route('user.list')->with('success_message', 'User has been deleted.');
	}

	private function _initNewUser() {
		return [
			"",	//ID
			"",	//Name
			"",	//Address
			"",	//Phone
			"",	//Last edited by
			"",	//Last edited time
			"",	//Khám tim
			""	//Khám mắt
		];
	}
}