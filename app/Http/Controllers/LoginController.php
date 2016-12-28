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
		// Get submit inputs
		$inputs = $request->all();

		// Validate
		$validator = Validator::make($inputs, [
            'username' => 'required',
			'password' => 'required'
        ]);

		if ($validator->fails()) {
            return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput();
        }

		// Init
		$googleSheetHelper = GoogleSheet::getInstance();
		$loginSheetId = Config::get('google.login_data_sheet');

		// Get login user data from google sheet
		$data = $googleSheetHelper->getSpreadSheetData($loginSheetId, 'Sheet1!A:D');

		// Check empty data login user
		if(empty($data)) {
			return redirect()->route('login')
                        ->withErrors('User data is empty')
                        ->withInput();
		}

		$username = $inputs['username'];
		$password = $inputs['password'];
		// Check login information
		foreach($data as $key => $user) {
			// Skip header row
			if($key == 0) continue;

			// Login information is correct
			if($user[1] == $username && $user[2] == $password) {

				// Store user data into session
				$request->session()->put('user', $user);

				return redirect()->intended(route('user.list'));
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