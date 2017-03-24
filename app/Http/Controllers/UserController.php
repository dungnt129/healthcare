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
		$users = $googleSheetHelper->getSpreadSheetData($userSheetId, 'Sheet1!A3:E');

		return view('user.index', [
			'users' => $users,
			'pageTitle' => 'Danh sách khách hàng',
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
			'pageTitle' => 'Tạo thông tin khách hàng',
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
			'pageTitle' => 'Cập nhật thông tin khách hàng',
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
//					'name' => 'required',
//					'address' => 'required',
//					'phone' => 'required'
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
		$lockDay5 = UserHelper::checkInputCompleteTab234($inputs, 5);
		$lockDay6 = UserHelper::checkInputCompleteTab234($inputs, 6);
		$lockDay7 = UserHelper::checkInputCompleteTab234($inputs, 7);
		$lockDay8 = UserHelper::checkInputCompleteTab234($inputs, 8);

		$dataTab1 = !empty($inputs['tab'][1]) ? $inputs['tab'][1] : "";
		$dataTab2 = !empty($inputs['tab'][2]) ? $inputs['tab'][2] : "";
		$dataTab3 = !empty($inputs['tab'][3]) ? $inputs['tab'][3] : "";
		$dataTab4 = !empty($inputs['tab'][4]) ? $inputs['tab'][4] : "";
		$dataTab5 = !empty($inputs['tab'][5]) ? $inputs['tab'][5] : "";
		$dataTab6 = !empty($inputs['tab'][6]) ? $inputs['tab'][6] : "";
		$dataTab7 = !empty($inputs['tab'][7]) ? $inputs['tab'][7] : "";
		$dataTab8 = !empty($inputs['tab'][8]) ? $inputs['tab'][8] : "";

		$dataTab1Encode = !empty($inputs['tab'][1]) ? json_encode($inputs['tab'][1]) : "";
		$dataTab2Encode = !empty($inputs['tab'][2]) ? json_encode($inputs['tab'][2]) : "";
		$dataTab3Encode = !empty($inputs['tab'][3]) ? json_encode($inputs['tab'][3]) : "";
		$dataTab4Encode = !empty($inputs['tab'][4]) ? json_encode($inputs['tab'][4]) : "";
		$dataTab5Encode = !empty($inputs['tab'][5]) ? json_encode($inputs['tab'][5]) : "";
		$dataTab6Encode = !empty($inputs['tab'][6]) ? json_encode($inputs['tab'][6]) : "";
		$dataTab7Encode = !empty($inputs['tab'][7]) ? json_encode($inputs['tab'][7]) : "";
		$dataTab8Encode = !empty($inputs['tab'][8]) ? json_encode($inputs['tab'][8]) : "";

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
			$updateRange = 'Sheet1!A' . $row . ':MQ' . $row;

			$values = [
				[
					// Cell values ...
					'0' => (int) $userId,
					'1' => $inputs["name"],
					'2' => $inputs["address"],
					'3' => $inputs["phone"],
					'4' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "maBenhNhan"),// mã bệnh nhân
					'5' => $inputs["email"],
					'6' => $inputs["zalo"],
					'7' => $inputs["facebook"],
					'8' => $inputs["image_url"],
					'9' => $currentUser['1'],
					'10' => date('d/m/Y H:i:s', time()),
					'11' => $dataTab1Encode,
					'12' => ($lockDay1) ? 1 : 0,
					'13' => $dataTab2Encode,
					'14' => ($lockDay2) ? 1 : 0,
					'15' => $dataTab3Encode,
					'16' => ($lockDay3) ? 1 : 0,
					'17' => $dataTab4Encode,
					'18' => ($lockDay4) ? 1 : 0,
					'19' => $dataTab5Encode,
					'20' => ($lockDay5) ? 1 : 0,
					'21' => $dataTab6Encode,
					'22' => ($lockDay6) ? 1 : 0,
					'23' => $dataTab7Encode,
					'24' => ($lockDay7) ? 1 : 0,
					'25' => $dataTab8Encode,
					'26' => ($lockDay8) ? 1 : 0,
					// Tab 1
					'27' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "tentuvanvien"),
					'28' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "date"),
					'29' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "accept"),
					'30' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "birthyear"),
					'31' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "sex"),
					'32' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "isVietnamese"),
					'33' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasHIVfriend"),
					'34' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasSexForCash"),
					'35' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasGiangMaiInLastYear"),
					'36' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasLauInLastYear"),
					'37' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasChlamydiaInLastYear"),
					'38' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManySexFriends"),
					'39' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'40' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCondomWhenAssSex"),
					'41' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'42' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCocainInLastYear"),
					'43' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAnotherCocainLastYear"),
					'44' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasPaidForPrEP"),
					'45' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "email"),
					'46' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "mobile"),
					'47' => (!empty(UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep"))) ? UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep") : UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrepText"),
					'48' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "otherComment"),
					'49' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "tenbacsi"),
					'50' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "date"),
					'51' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresult"),
					'52' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresultdate"),
					'53' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresult"),
					'54' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresultdate"),
					'55' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "viemGanBresult"),
					'56' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "viemGanBresultdate"),
					'57' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresult"),
					'58' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresultdate"),
					'59' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresult"),
					'60' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresultdate"),
					'61' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresult"),
					'62' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresultdate"),
					'63' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresult"),
					'64' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresultdate"),
					'65' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResult"),
					'66' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResultDate"),
					'67' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResult"),
					'68' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResultDate"),
					'69' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "otherComment"),
					'70' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "tentuvanvien"),
					'71' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "date"),
					'72' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "accept_prep"),
					'73' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "maBenhNhan"),
					'74' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "otherComment"),
					// Tab 2
					'75' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "tentuvanvien"),
					'76' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "date"),
					'77' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "report_number"),
					'78' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "real_number"),
					'79' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasTieuChay"),
					'80' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasTired"),
					'81' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasPoisonGan"),
					'82' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasChangedEmotion"),
					'83' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasBuonNon"),
					'84' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasManNgua"),
					'85' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasNonMua"),
					'86' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "howManySexFriends"),
					'87' => UserHelper::getShowDataDay234($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'88' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasCondomWhenAssSex"),
					'89' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'90' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasCocainInLastYear"),
					'91' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "otherComment"),
					'92' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "tenbacsi"),
					'93' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "date"),
					'94' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "fastHIVresult"),
					'95' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "fastHIVresultdate"),
					'96' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "confirmHIVresult"),
					'97' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "confirmHIVresultdate"),
					'98' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "chucnangthanResult"),
					'99' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "chucnangthanResultDate"),
					'100' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "hasSideEffects"),
					'101' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "antiHCVresult"),
					'102' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "antiHCVresultdate"),
					'103' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "VDRLRPRresult"),
					'104' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "VDRLRPRresultdate"),
					'105' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "poisonGanResult"),
					'106' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "poisonGanResultDate"),
					'107' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "otherComment"),
					'108' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "tentuvanvien"),
					'109' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "date"),
					'110' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "hasHIV"),
					'111' => (!empty(UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReasonText"),
					'112' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "HIVdate"),
					'113' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "tenofivirDate"),
					'114' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherComment"),
					// Tab 3
					'115' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "tentuvanvien"),
					'116' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "date"),
					'117' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "report_number"),
					'118' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "real_number"),
					'119' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasTieuChay"),
					'120' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasTired"),
					'121' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasPoisonGan"),
					'122' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasChangedEmotion"),
					'123' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasBuonNon"),
					'124' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasManNgua"),
					'125' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasNonMua"),
					'126' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "howManySexFriends"),
					'127' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "howManyAssSexFriends"),
					'128' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasCondomWhenAssSex"),
					'129' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'130' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasCocainInLastYear"),
					'131' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "otherComment"),
					'132' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "tenbacsi"),
					'133' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "date"),
					'134' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "fastHIVresult"),
					'135' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "fastHIVresultdate"),
					'136' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "confirmHIVresult"),
					'137' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "confirmHIVresultdate"),
					'138' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "chucnangthanResult"),
					'139' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "chucnangthanResultDate"),
					'140' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "hasSideEffects"),
					'141' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "antiHCVresult"),
					'142' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "antiHCVresultdate"),
					'143' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "VDRLRPRresult"),
					'144' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "VDRLRPRresultdate"),
					'145' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "poisonGanResult"),
					'146' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "poisonGanResultDate"),
					'147' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "otherComment"),
					'148' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "tentuvanvien"),
					'149' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "date"),
					'150' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "hasHIV"),
					'151' => !empty(UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReason")) ? UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReasonText"),
					'152' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "HIVdate"),
					'153' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "tenofivirDate"),
					'154' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherComment"),
					// Tab 4
					'155' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "tentuvanvien"),
					'156' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "date"),
					'157' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "report_number"),
					'158' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "real_number"),
					'159' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasTieuChay"),
					'160' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasTired"),
					'161' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasPoisonGan"),
					'162' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasChangedEmotion"),
					'163' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasBuonNon"),
					'164' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasManNgua"),
					'165' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasNonMua"),
					'166' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "howManySexFriends"),
					'167' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "howManyAssSexFriends"),
					'168' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasCondomWhenAssSex"),
					'169' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'170' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasCocainInLastYear"),
					'171' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "otherComment"),
					'172' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "tenbacsi"),
					'173' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "date"),
					'174' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "fastHIVresult"),
					'175' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "fastHIVresultdate"),
					'176' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "confirmHIVresult"),
					'177' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "confirmHIVresultdate"),
					'178' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "chucnangthanResult"),
					'179' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "chucnangthanResultDate"),
					'180' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "hasSideEffects"),
					'181' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "antiHCVresult"),
					'182' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "antiHCVresultdate"),
					'183' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "VDRLRPRresult"),
					'184' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "VDRLRPRresultdate"),
					'185' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "poisonGanResult"),
					'186' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "poisonGanResultDate"),
					'187' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "otherComment"),
					'188' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "tentuvanvien"),
					'189' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "date"),
					'190' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "hasHIV"),
					'191' => (!empty(UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReasonText"),
					'192' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "HIVdate"),
					'193' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "tenofivirDate"),
					'194' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherComment"),
					// Tab 5
					'195' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "tentuvanvien"),
					'196' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "date"),
					'197' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "report_number"),
					'198' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "real_number"),
					'199' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasTieuChay"),
					'200' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasTired"),
					'201' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasPoisonGan"),
					'202' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasChangedEmotion"),
					'203' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasBuonNon"),
					'204' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasManNgua"),
					'205' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasNonMua"),
					'206' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "howManySexFriends"),
					'207' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "howManyAssSexFriends"),
					'208' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasCondomWhenAssSex"),
					'209' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'210' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasCocainInLastYear"),
					'211' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "otherComment"),
					'212' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "tenbacsi"),
					'213' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "date"),
					'214' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "fastHIVresult"),
					'215' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "fastHIVresultdate"),
					'216' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "confirmHIVresult"),
					'217' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "confirmHIVresultdate"),
					'218' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "chucnangthanResult"),
					'219' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "chucnangthanResultDate"),
					'220' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "hasSideEffects"),
					'221' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "antiHCVresult"),
					'222' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "antiHCVresultdate"),
					'223' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "VDRLRPRresult"),
					'224' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "VDRLRPRresultdate"),
					'225' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "poisonGanResult"),
					'226' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "poisonGanResultDate"),
					'227' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "otherComment"),
					'228' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "tentuvanvien"),
					'229' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "date"),
					'230' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "hasHIV"),
					'231' => (!empty(UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReasonText"),
					'232' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "HIVdate"),
					'233' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "tenofivirDate"),
					'234' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherComment"),
					// Tab 6
					'235' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "tentuvanvien"),
					'236' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "date"),
					'237' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "report_number"),
					'238' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "real_number"),
					'239' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasTieuChay"),
					'240' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasTired"),
					'241' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasPoisonGan"),
					'242' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasChangedEmotion"),
					'243' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasBuonNon"),
					'244' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasManNgua"),
					'157' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasNonMua"),
					'158' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "howManySexFriends"),
					'159' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "howManyAssSexFriends"),
					'160' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasCondomWhenAssSex"),
					'161' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'162' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasCocainInLastYear"),
					'163' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "otherComment"),
					'164' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "tenbacsi"),
					'165' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "date"),
					'166' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "fastHIVresult"),
					'167' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "fastHIVresultdate"),
					'168' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "confirmHIVresult"),
					'169' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "confirmHIVresultdate"),
					'170' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "chucnangthanResult"),
					'171' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "chucnangthanResultDate"),
					'172' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "hasSideEffects"),
					'173' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "antiHCVresult"),
					'174' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "antiHCVresultdate"),
					'175' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "VDRLRPRresult"),
					'176' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "VDRLRPRresultdate"),
					'177' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "poisonGanResult"),
					'178' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "poisonGanResultDate"),
					'179' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "otherComment"),
					'180' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "tentuvanvien"),
					'181' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "date"),
					'182' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "hasHIV"),
					'183' => (!empty(UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReasonText"),
					'184' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "HIVdate"),
					'185' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "tenofivirDate"),
					'186' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherComment"),
					// Tab 7
					'147' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "tentuvanvien"),
					'148' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "date"),
					'149' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "report_number"),
					'150' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "real_number"),
					'151' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasTieuChay"),
					'152' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasTired"),
					'153' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasPoisonGan"),
					'154' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasChangedEmotion"),
					'155' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasBuonNon"),
					'156' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasManNgua"),
					'157' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasNonMua"),
					'158' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "howManySexFriends"),
					'159' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "howManyAssSexFriends"),
					'160' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasCondomWhenAssSex"),
					'161' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'162' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasCocainInLastYear"),
					'163' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "otherComment"),
					'164' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "tenbacsi"),
					'165' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "date"),
					'166' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "fastHIVresult"),
					'167' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "fastHIVresultdate"),
					'168' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "confirmHIVresult"),
					'169' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "confirmHIVresultdate"),
					'170' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "chucnangthanResult"),
					'171' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "chucnangthanResultDate"),
					'172' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "hasSideEffects"),
					'173' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "antiHCVresult"),
					'174' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "antiHCVresultdate"),
					'175' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "VDRLRPRresult"),
					'176' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "VDRLRPRresultdate"),
					'177' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "poisonGanResult"),
					'178' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "poisonGanResultDate"),
					'179' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "otherComment"),
					'180' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "tentuvanvien"),
					'181' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "date"),
					'182' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "hasHIV"),
					'183' => (!empty(UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReasonText"),
					'184' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "HIVdate"),
					'185' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "tenofivirDate"),
					'186' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherComment"),
					// Tab 8
					'147' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "tentuvanvien"),
					'148' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "date"),
					'149' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "report_number"),
					'150' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "real_number"),
					'151' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasTieuChay"),
					'152' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasTired"),
					'153' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasPoisonGan"),
					'154' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasChangedEmotion"),
					'155' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasBuonNon"),
					'156' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasManNgua"),
					'157' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasNonMua"),
					'158' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "howManySexFriends"),
					'159' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "howManyAssSexFriends"),
					'160' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasCondomWhenAssSex"),
					'161' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'162' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasCocainInLastYear"),
					'163' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "otherComment"),
					'164' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "tenbacsi"),
					'165' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "date"),
					'166' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "fastHIVresult"),
					'167' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "fastHIVresultdate"),
					'168' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "confirmHIVresult"),
					'169' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "confirmHIVresultdate"),
					'170' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "chucnangthanResult"),
					'171' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "chucnangthanResultDate"),
					'172' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "hasSideEffects"),
					'173' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "antiHCVresult"),
					'174' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "antiHCVresultdate"),
					'175' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "VDRLRPRresult"),
					'176' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "VDRLRPRresultdate"),
					'177' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "poisonGanResult"),
					'178' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "poisonGanResultDate"),
					'179' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "otherComment"),
					'180' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "tentuvanvien"),
					'181' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "date"),
					'182' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "hasHIV"),
					'183' => (!empty(UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReasonText"),
					'184' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "HIVdate"),
					'185' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "tenofivirDate"),
					'186' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherComment"),
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
			$updateRange = 'Sheet1!A:MQ';
			$values = [
				[
					// Cell values ...
					'0' => (int) $nextId,
					'1' => $inputs["name"],
					'2' => $inputs["address"],
					'3' => $inputs["phone"],
					'4' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "maBenhNhan"),// mã bệnh nhân
					'5' => $inputs["email"],
					'6' => $inputs["zalo"],
					'7' => $inputs["facebook"],
					'8' => $inputs["image_url"],
					'9' => $currentUser['1'],
					'10' => date('d/m/Y H:i:s', time()),
					'11' => $dataTab1Encode,
					'12' => ($lockDay1) ? 1 : 0,
					'13' => $dataTab2Encode,
					'14' => ($lockDay2) ? 1 : 0,
					'15' => $dataTab3Encode,
					'16' => ($lockDay3) ? 1 : 0,
					'17' => $dataTab4Encode,
					'18' => ($lockDay4) ? 1 : 0,
					'19' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "tentuvanvien"),
					'20' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "date"),
					'21' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "accept"),
					'22' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "birthyear"),
					'23' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "sex"),
					'24' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "isVietnamese"),
					'25' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasHIVfriend"),
					'26' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasSexForCash"),
					'27' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasGiangMaiInLastYear"),
					'28' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasLauInLastYear"),
					'29' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasChlamydiaInLastYear"),
					'30' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManySexFriends"),
					'31' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'32' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCondomWhenAssSex"),
					'33' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'34' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCocainInLastYear"),
					'35' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAnotherCocainLastYear"),
					'36' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasPaidForPrEP"),
					'37' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "email"),
					'38' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "mobile"),
					'39' => (!empty(UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep"))) ? UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep") : UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrepText"),
					'40' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "otherComment"),
					'41' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "tenbacsi"),
					'42' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "date"),
					'43' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresult"),
					'44' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresultdate"),
					'45' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresult"),
					'46' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresultdate"),
					'47' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "viemGanBresult"),
					'48' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "viemGanBresultdate"),
					'49' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresult"),
					'50' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresultdate"),
					'51' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresult"),
					'52' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresultdate"),
					'53' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresult"),
					'54' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresultdate"),
					'55' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresult"),
					'56' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresultdate"),
					'57' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResult"),
					'58' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResultDate"),
					'59' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResult"),
					'60' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResultDate"),
					'61' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "otherComment"),
					'62' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "tentuvanvien"),
					'63' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "date"),
					'64' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "accept_prep"),
					'65' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "maBenhNhan"),
					'66' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "otherComment"),
					// Tab 2
					'67' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "tentuvanvien"),
					'68' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "date"),
					'69' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "report_number"),
					'70' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "real_number"),
					'71' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasTieuChay"),
					'72' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasTired"),
					'73' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasPoisonGan"),
					'74' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasChangedEmotion"),
					'75' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasBuonNon"),
					'76' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasManNgua"),
					'77' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasNonMua"),
					'78' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "howManySexFriends"),
					'79' => UserHelper::getShowDataDay234($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'80' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasCondomWhenAssSex"),
					'81' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'82' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasCocainInLastYear"),
					'83' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "otherComment"),
					'84' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "tenbacsi"),
					'85' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "date"),
					'86' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "fastHIVresult"),
					'87' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "fastHIVresultdate"),
					'88' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "confirmHIVresult"),
					'89' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "confirmHIVresultdate"),
					'90' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "chucnangthanResult"),
					'91' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "chucnangthanResultDate"),
					'92' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "hasSideEffects"),
					'93' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "antiHCVresult"),
					'94' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "antiHCVresultdate"),
					'95' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "VDRLRPRresult"),
					'96' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "VDRLRPRresultdate"),
					'97' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "poisonGanResult"),
					'98' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "poisonGanResultDate"),
					'99' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "otherComment"),
					'100' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "tentuvanvien"),
					'101' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "date"),
					'102' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "hasHIV"),
					'103' => (!empty(UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReasonText"),
					'104' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "HIVdate"),
					'105' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "tenofivirDate"),
					'106' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherComment"),
					// Tab 3
					'107' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "tentuvanvien"),
					'108' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "date"),
					'109' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "report_number"),
					'110' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "real_number"),
					'111' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasTieuChay"),
					'112' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasTired"),
					'113' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasPoisonGan"),
					'114' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasChangedEmotion"),
					'115' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasBuonNon"),
					'116' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasManNgua"),
					'117' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasNonMua"),
					'118' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "howManySexFriends"),
					'119' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "howManyAssSexFriends"),
					'120' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasCondomWhenAssSex"),
					'121' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'122' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasCocainInLastYear"),
					'123' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "otherComment"),
					'124' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "tenbacsi"),
					'125' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "date"),
					'126' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "fastHIVresult"),
					'127' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "fastHIVresultdate"),
					'128' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "confirmHIVresult"),
					'129' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "confirmHIVresultdate"),
					'130' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "chucnangthanResult"),
					'131' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "chucnangthanResultDate"),
					'132' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "hasSideEffects"),
					'133' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "antiHCVresult"),
					'134' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "antiHCVresultdate"),
					'135' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "VDRLRPRresult"),
					'136' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "VDRLRPRresultdate"),
					'137' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "poisonGanResult"),
					'138' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "poisonGanResultDate"),
					'139' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "otherComment"),
					'140' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "tentuvanvien"),
					'141' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "date"),
					'142' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "hasHIV"),
					'143' => (!empty(UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReasonText"),
					'144' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "HIVdate"),
					'145' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "tenofivirDate"),
					'146' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherComment"),
					// Tab 4
					'147' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "tentuvanvien"),
					'148' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "date"),
					'149' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "report_number"),
					'150' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "real_number"),
					'151' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasTieuChay"),
					'152' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasTired"),
					'153' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasPoisonGan"),
					'154' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasChangedEmotion"),
					'155' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasBuonNon"),
					'156' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasManNgua"),
					'157' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasNonMua"),
					'158' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "howManySexFriends"),
					'159' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "howManyAssSexFriends"),
					'160' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasCondomWhenAssSex"),
					'161' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'162' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasCocainInLastYear"),
					'163' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "otherComment"),
					'164' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "tenbacsi"),
					'165' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "date"),
					'166' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "fastHIVresult"),
					'167' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "fastHIVresultdate"),
					'168' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "confirmHIVresult"),
					'169' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "confirmHIVresultdate"),
					'170' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "chucnangthanResult"),
					'171' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "chucnangthanResultDate"),
					'172' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "hasSideEffects"),
					'173' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "antiHCVresult"),
					'174' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "antiHCVresultdate"),
					'175' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "VDRLRPRresult"),
					'176' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "VDRLRPRresultdate"),
					'177' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "poisonGanResult"),
					'178' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "poisonGanResultDate"),
					'179' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "otherComment"),
					'180' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "tentuvanvien"),
					'181' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "date"),
					'182' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "hasHIV"),
					'183' => (!empty(UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReasonText"),
					'184' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "HIVdate"),
					'185' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "tenofivirDate"),
					'186' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherComment"),
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
			"", //Email
			"", //Zalo
			"", //Facebook
			"", //Image
			"", //Mã bệnh nhân
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
