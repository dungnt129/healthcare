<?php namespace App\Http\Controllers;

use App\Helpers\GoogleSheet;
use Illuminate\Http\Request;
use Validator;
use Config;

/**
 *
 * Login Controller
 *
 * @todo Handle user login/logout
 * @author DungNT
 *
 */
class LoginController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Display form login
    |--------------------------------------------------------------------------
    |
    | Show login form
    |
    */
    public function index() {
		$base_url = url('/');
		// Save access page before login to redirect after login success
		$previousUrl = redirect()->getUrlGenerator()->previous();
		if(!session()->has('url.intended') && strpos($previousUrl, $base_url) !== false){
            session()->put('url.intended', $previousUrl);
        }

		return view('login.index');
    }

	/*
    |--------------------------------------------------------------------------
    | Post Login
    |--------------------------------------------------------------------------
    |
    | Handle submit form login
    |
    */
    public function postLogin(Request $request) {

		// Validate
		$validator = Validator::make($request->all(), [
            'username' => 'required',
			'password' => 'required'
        ]);

		if ($validator->fails()) {
            return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput();
        }

		// Init
		$googleSheetHelper = new GoogleSheet();
		$loginSheetId = Config::get('google.login_data_sheet');

		// Get login user data from google sheet
		$data = $googleSheetHelper->getSpreadSheetData($loginSheetId);

		// Check empty data login user
		if(empty($data)) {
			return redirect()->route('login')
                        ->withErrors('User data is empty')
                        ->withInput();
		}

		$username = $request->input('username');
		$password = $request->input('password');
		// Check login information
		foreach($data as $key => $user) {
			// Skip header row
			if($key == 0) continue;

			// Login information is correct
			if($user[1] == $username && $user[2] == $password) {

				// Store user data into session
				$request->session()->put('user', $user);

				// If user is admin
//				if($user[3] == 1) {
					return redirect()->intended(route('user.list'));
//				} else {
//					// Normal, go to user detail page
//					return redirect()->route('user.detail', ['user_id' => $user[0]]);
//				}

			}
		}

		return redirect()->route('login')
                        ->withErrors('Username or Password is incorrect')
                        ->withInput();
    }

	/*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    |
    | Handle logout
    |
    */
	public function getLogout(Request $request) {
		// Clear all session
		$request->session()->flush();

		return redirect()->route('login');
	}
}