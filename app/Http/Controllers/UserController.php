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

        // Check hide other tabs
        $isDisableOtherTabs = ((!empty($user[11]["tuvanvien1"]["checkCondition"]) && $user[11]["tuvanvien1"]["checkCondition"] == 2) || (!empty($user[11]["bacsi"]["checkCondition"]) && $user[11]["bacsi"]["checkCondition"] == 2));

		return view('user.update', [
			'user' => $user,
			'loginUser' => $loginUser,
            'isDisableOtherTabs' => $isDisableOtherTabs,
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
								->with('fail_message', 'Lỗi hệ thống.Thông tin khách hàng chưa được lưu.')
								->withInput();
			}

			// Update data
			$updateRange = 'Sheet1!A' . $row . ':MS' . $row;

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
					'27' => $inputs['other_visit'],
					// Tab 1
					'28' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "tentuvanvien"),
					'29' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "date"),
					'30' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "accept"),
					'31' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "birthyear"),
					'32' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "sex"),
					'33' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "isVietnamese"),
					'34' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasHIVfriend"),
					'35' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasSexForCash"),
					'36' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasGiangMaiInLastYear"),
					'37' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasLauInLastYear"),
					'38' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasChlamydiaInLastYear"),
					'39' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManySexFriends"),
					'40' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'41' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCondomWhenAssSex"),
					'42' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'43' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCocainInLastYear"),
					'44' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAnotherCocainLastYear"),
					'45' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasPaidForPrEP"),
					'46' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "monthSalary"),
					'47' => (!empty(UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep"))) ? UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep") : UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrepText"),
					'48' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "checkCondition"),
					'49' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "otherComment"),
					'50' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "tenbacsi"),
					'51' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "date"),
					'52' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresult"),
					'53' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresultdate"),
					'54' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresult"),
					'55' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresultdate"),
					'56' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresult"),
					'57' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresultdate"),
					'58' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresult"),
					'59' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresultdate"),
					'60' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresult"),
					'61' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresultdate"),
					'62' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresult"),
					'63' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresultdate"),
					'64' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResult"),
					'65' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResultDate"),
					'66' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResult"),
					'67' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResultDate"),
                    '68' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "checkCondition"),
					'69' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "otherComment"),
					'70' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "tentuvanvien"),
					'71' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "date"),
					'72' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "accept_prep"),
                    '73' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "otherReasonText"),
					'74' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "maBenhNhan"),
					'75' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "otherComment"),
					// Tab 2
					'76' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "tentuvanvien"),
					'77' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "date"),
					'78' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "report_number"),
					'79' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "real_number"),
					'80' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasTieuChay"),
					'81' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasTired"),
					'82' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasPoisonGan"),
					'83' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasChangedEmotion"),
					'84' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasBuonNon"),
					'85' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasManNgua"),
					'86' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasNonMua"),
					'87' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "howManySexFriends"),
					'88' => UserHelper::getShowDataDay234($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'89' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasCondomWhenAssSex"),
					'90' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'91' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasCocainInLastYear"),
					'92' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "otherComment"),
					'93' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "tenbacsi"),
					'94' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "date"),
					'95' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "fastHIVresult"),
					'96' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "fastHIVresultdate"),
					'97' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "confirmHIVresult"),
					'98' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "confirmHIVresultdate"),
					'99' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "chucnangthanResult"),
					'100' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "chucnangthanResultDate"),
					'101' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "hasSideEffects"),
					'102' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "antiHCVresult"),
					'103' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "antiHCVresultdate"),
					'104' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "VDRLRPRresult"),
					'105' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "VDRLRPRresultdate"),
					'106' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "poisonGanResult"),
					'107' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "poisonGanResultDate"),
					'108' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "otherComment"),
					'109' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "tentuvanvien"),
					'110' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "date"),
					'111' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "hasHIV"),
					'112' => (!empty(UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReasonText"),
					'113' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "HIVdate"),
					'114' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "tenofivirDate"),
					'115' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherComment"),
					// Tab 3
					'116' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "tentuvanvien"),
					'117' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "date"),
					'118' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "report_number"),
					'119' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "real_number"),
					'120' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasTieuChay"),
					'121' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasTired"),
					'122' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasPoisonGan"),
					'123' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasChangedEmotion"),
					'124' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasBuonNon"),
					'125' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasManNgua"),
					'126' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasNonMua"),
					'127' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "howManySexFriends"),
					'128' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "howManyAssSexFriends"),
					'129' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasCondomWhenAssSex"),
					'130' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'131' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasCocainInLastYear"),
					'132' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "otherComment"),
					'133' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "tenbacsi"),
					'134' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "date"),
					'135' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "fastHIVresult"),
					'136' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "fastHIVresultdate"),
					'137' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "confirmHIVresult"),
					'138' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "confirmHIVresultdate"),
					'139' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "chucnangthanResult"),
					'140' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "chucnangthanResultDate"),
					'141' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "hasSideEffects"),
					'142' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "antiHCVresult"),
					'143' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "antiHCVresultdate"),
					'144' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "VDRLRPRresult"),
					'145' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "VDRLRPRresultdate"),
					'146' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "poisonGanResult"),
					'147' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "poisonGanResultDate"),
					'148' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "otherComment"),
					'149' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "tentuvanvien"),
					'150' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "date"),
					'151' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "hasHIV"),
					'152' => !empty(UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReason")) ? UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReasonText"),
					'153' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "HIVdate"),
					'154' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "tenofivirDate"),
					'155' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherComment"),
					// Tab 4
					'156' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "tentuvanvien"),
					'157' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "date"),
					'158' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "report_number"),
					'159' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "real_number"),
					'160' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasTieuChay"),
					'161' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasTired"),
					'162' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasPoisonGan"),
					'163' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasChangedEmotion"),
					'164' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasBuonNon"),
					'165' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasManNgua"),
					'166' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasNonMua"),
					'167' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "howManySexFriends"),
					'168' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "howManyAssSexFriends"),
					'169' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasCondomWhenAssSex"),
					'170' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'171' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasCocainInLastYear"),
					'172' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "otherComment"),
					'173' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "tenbacsi"),
					'174' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "date"),
					'175' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "fastHIVresult"),
					'176' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "fastHIVresultdate"),
					'177' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "confirmHIVresult"),
					'178' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "confirmHIVresultdate"),
					'179' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "chucnangthanResult"),
					'180' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "chucnangthanResultDate"),
					'181' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "hasSideEffects"),
					'182' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "antiHCVresult"),
					'183' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "antiHCVresultdate"),
					'184' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "VDRLRPRresult"),
					'185' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "VDRLRPRresultdate"),
					'186' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "poisonGanResult"),
					'187' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "poisonGanResultDate"),
					'188' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "otherComment"),
					'189' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "tentuvanvien"),
					'190' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "date"),
					'191' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "hasHIV"),
					'192' => (!empty(UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReasonText"),
					'193' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "HIVdate"),
					'194' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "tenofivirDate"),
					'195' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherComment"),
					// Tab 5
					'196' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "tentuvanvien"),
					'197' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "date"),
					'198' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "report_number"),
					'199' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "real_number"),
					'200' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasTieuChay"),
					'201' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasTired"),
					'202' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasPoisonGan"),
					'203' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasChangedEmotion"),
					'204' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasBuonNon"),
					'205' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasManNgua"),
					'206' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasNonMua"),
					'207' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "howManySexFriends"),
					'208' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "howManyAssSexFriends"),
					'209' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasCondomWhenAssSex"),
					'210' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'211' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasCocainInLastYear"),
					'212' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "otherComment"),
					'213' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "tenbacsi"),
					'214' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "date"),
					'215' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "fastHIVresult"),
					'216' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "fastHIVresultdate"),
					'217' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "confirmHIVresult"),
					'218' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "confirmHIVresultdate"),
					'219' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "chucnangthanResult"),
					'220' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "chucnangthanResultDate"),
					'221' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "hasSideEffects"),
					'222' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "antiHCVresult"),
					'223' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "antiHCVresultdate"),
					'224' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "VDRLRPRresult"),
					'225' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "VDRLRPRresultdate"),
					'226' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "poisonGanResult"),
					'227' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "poisonGanResultDate"),
					'228' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "otherComment"),
					'229' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "tentuvanvien"),
					'230' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "date"),
					'231' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "hasHIV"),
					'232' => (!empty(UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReasonText"),
					'233' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "HIVdate"),
					'234' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "tenofivirDate"),
					'235' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherComment"),
					// Tab 6
					'236' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "tentuvanvien"),
					'237' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "date"),
					'238' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "report_number"),
					'239' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "real_number"),
					'240' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasTieuChay"),
					'241' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasTired"),
					'242' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasPoisonGan"),
					'243' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasChangedEmotion"),
					'244' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasBuonNon"),
					'245' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasManNgua"),
					'246' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasNonMua"),
					'247' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "howManySexFriends"),
					'248' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "howManyAssSexFriends"),
					'249' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasCondomWhenAssSex"),
					'250' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'251' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasCocainInLastYear"),
					'252' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "otherComment"),
					'253' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "tenbacsi"),
					'254' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "date"),
					'255' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "fastHIVresult"),
					'256' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "fastHIVresultdate"),
					'257' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "confirmHIVresult"),
					'258' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "confirmHIVresultdate"),
					'259' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "chucnangthanResult"),
					'260' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "chucnangthanResultDate"),
					'261' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "hasSideEffects"),
					'262' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "antiHCVresult"),
					'263' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "antiHCVresultdate"),
					'264' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "VDRLRPRresult"),
					'265' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "VDRLRPRresultdate"),
					'266' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "poisonGanResult"),
					'267' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "poisonGanResultDate"),
					'268' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "otherComment"),
					'269' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "tentuvanvien"),
					'270' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "date"),
					'271' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "hasHIV"),
					'272' => (!empty(UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReasonText"),
					'273' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "HIVdate"),
					'274' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "tenofivirDate"),
					'275' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherComment"),
					// Tab 7
					'276' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "tentuvanvien"),
					'277' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "date"),
					'278' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "report_number"),
					'279' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "real_number"),
					'280' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasTieuChay"),
					'281' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasTired"),
					'282' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasPoisonGan"),
					'283' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasChangedEmotion"),
					'284' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasBuonNon"),
					'285' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasManNgua"),
					'286' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasNonMua"),
					'287' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "howManySexFriends"),
					'288' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "howManyAssSexFriends"),
					'289' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasCondomWhenAssSex"),
					'290' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'291' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasCocainInLastYear"),
					'292' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "otherComment"),
					'293' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "tenbacsi"),
					'294' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "date"),
					'295' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "fastHIVresult"),
					'296' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "fastHIVresultdate"),
					'297' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "confirmHIVresult"),
					'298' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "confirmHIVresultdate"),
					'299' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "chucnangthanResult"),
					'300' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "chucnangthanResultDate"),
					'301' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "hasSideEffects"),
					'302' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "antiHCVresult"),
					'303' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "antiHCVresultdate"),
					'304' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "VDRLRPRresult"),
					'305' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "VDRLRPRresultdate"),
					'306' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "poisonGanResult"),
					'307' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "poisonGanResultDate"),
					'308' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "otherComment"),
					'309' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "tentuvanvien"),
					'310' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "date"),
					'311' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "hasHIV"),
					'312' => (!empty(UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReasonText"),
					'313' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "HIVdate"),
					'314' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "tenofivirDate"),
					'315' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherComment"),
					// Tab 8
					'316' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "tentuvanvien"),
					'317' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "date"),
					'318' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "report_number"),
					'319' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "real_number"),
					'320' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasTieuChay"),
					'321' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasTired"),
					'322' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasPoisonGan"),
					'323' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasChangedEmotion"),
					'324' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasBuonNon"),
					'325' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasManNgua"),
					'326' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasNonMua"),
					'327' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "howManySexFriends"),
					'328' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "howManyAssSexFriends"),
					'329' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasCondomWhenAssSex"),
					'330' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'331' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasCocainInLastYear"),
					'332' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "otherComment"),
					'333' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "tenbacsi"),
					'334' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "date"),
					'335' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "fastHIVresult"),
					'336' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "fastHIVresultdate"),
					'337' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "confirmHIVresult"),
					'338' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "confirmHIVresultdate"),
					'339' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "chucnangthanResult"),
					'340' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "chucnangthanResultDate"),
					'341' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "hasSideEffects"),
					'342' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "antiHCVresult"),
					'343' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "antiHCVresultdate"),
					'344' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "VDRLRPRresult"),
					'345' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "VDRLRPRresultdate"),
					'346' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "poisonGanResult"),
					'347' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "poisonGanResultDate"),
					'348' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "otherComment"),
					'349' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "tentuvanvien"),
					'350' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "date"),
					'351' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "hasHIV"),
					'352' => (!empty(UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReasonText"),
					'353' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "HIVdate"),
					'354' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "tenofivirDate"),
					'355' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherComment"),
					'356' => $inputs['other_visit']
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
			$updateRange = 'Sheet1!A:MS';
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
					'19' => $dataTab5Encode,
					'20' => ($lockDay5) ? 1 : 0,
					'21' => $dataTab6Encode,
					'22' => ($lockDay6) ? 1 : 0,
					'23' => $dataTab7Encode,
					'24' => ($lockDay7) ? 1 : 0,
					'25' => $dataTab8Encode,
					'26' => ($lockDay8) ? 1 : 0,
					'27' => $inputs['other_visit'],
					// Tab 1
					'28' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "tentuvanvien"),
					'29' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "date"),
					'30' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "accept"),
					'31' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "birthyear"),
					'32' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "sex"),
					'33' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "isVietnamese"),
					'34' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasHIVfriend"),
					'35' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasSexForCash"),
					'36' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasGiangMaiInLastYear"),
					'37' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasLauInLastYear"),
					'38' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasChlamydiaInLastYear"),
					'39' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManySexFriends"),
					'40' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'41' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCondomWhenAssSex"),
					'42' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'43' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasCocainInLastYear"),
					'44' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasAnotherCocainLastYear"),
					'45' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "hasPaidForPrEP"),
					'46' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "monthSalary"),
					'47' => (!empty(UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep"))) ? UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrep") : UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "howDoYouKnowPrepText"),
					'48' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "checkCondition"),
                    '49' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien1", "otherComment"),
					'50' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "tenbacsi"),
					'51' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "date"),
					'52' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresult"),
					'53' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "fastHIVresultdate"),
					'54' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresult"),
					'55' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "confirmHIVresultdate"),
					'56' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresult"),
					'57' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "sangLocViemGanBresultdate"),
					'58' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresult"),
					'59' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHBsresultdate"),
					'60' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresult"),
					'61' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHCVresultdate"),
					'62' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresult"),
					'63' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "antiHAVresultdate"),
					'64' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResult"),
					'65' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "giangmaiResultDate"),
					'66' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResult"),
					'67' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "chucnangthanResultDate"),
                    '68' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "checkCondition"),
					'69' => UserHelper::getShowDataDay1($dataTab1, "bacsi", "otherComment"),
					'70' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "tentuvanvien"),
					'71' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "date"),
					'72' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "accept_prep"),
                    '73' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "otherReasonText"),
					'74' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "maBenhNhan"),
					'75' => UserHelper::getShowDataDay1($dataTab1, "tuvanvien3", "otherComment"),
					// Tab 2
					'76' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "tentuvanvien"),
					'77' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "date"),
					'78' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "report_number"),
					'79' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "real_number"),
					'80' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasTieuChay"),
					'81' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasTired"),
					'82' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasPoisonGan"),
					'83' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasChangedEmotion"),
					'84' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasBuonNon"),
					'85' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasManNgua"),
					'86' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasNonMua"),
					'87' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "howManySexFriends"),
					'88' => UserHelper::getShowDataDay234($dataTab1, "tuvanvien1", "howManyAssSexFriends"),
					'89' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasCondomWhenAssSex"),
					'90' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'91' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "hasCocainInLastYear"),
					'92' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien1", "otherComment"),
					'93' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "tenbacsi"),
					'94' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "date"),
					'95' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "fastHIVresult"),
					'96' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "fastHIVresultdate"),
					'97' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "confirmHIVresult"),
					'98' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "confirmHIVresultdate"),
					'99' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "chucnangthanResult"),
					'100' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "chucnangthanResultDate"),
					'101' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "hasSideEffects"),
					'102' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "antiHCVresult"),
					'103' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "antiHCVresultdate"),
					'104' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "VDRLRPRresult"),
					'105' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "VDRLRPRresultdate"),
					'106' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "poisonGanResult"),
					'107' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "poisonGanResultDate"),
					'108' => UserHelper::getShowDataDay234($dataTab2, "bacsi", "otherComment"),
					'109' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "tentuvanvien"),
					'110' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "date"),
					'111' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "hasHIV"),
					'112' => (!empty(UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherReasonText"),
					'113' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "HIVdate"),
					'114' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "tenofivirDate"),
					'115' => UserHelper::getShowDataDay234($dataTab2, "tuvanvien3", "otherComment"),
					// Tab 3
					'116' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "tentuvanvien"),
					'117' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "date"),
					'118' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "report_number"),
					'119' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "real_number"),
					'120' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasTieuChay"),
					'121' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasTired"),
					'122' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasPoisonGan"),
					'123' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasChangedEmotion"),
					'124' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasBuonNon"),
					'125' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasManNgua"),
					'126' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasNonMua"),
					'127' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "howManySexFriends"),
					'128' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "howManyAssSexFriends"),
					'129' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasCondomWhenAssSex"),
					'130' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'131' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "hasCocainInLastYear"),
					'132' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien1", "otherComment"),
					'133' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "tenbacsi"),
					'134' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "date"),
					'135' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "fastHIVresult"),
					'136' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "fastHIVresultdate"),
					'137' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "confirmHIVresult"),
					'138' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "confirmHIVresultdate"),
					'139' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "chucnangthanResult"),
					'140' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "chucnangthanResultDate"),
					'141' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "hasSideEffects"),
					'142' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "antiHCVresult"),
					'143' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "antiHCVresultdate"),
					'144' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "VDRLRPRresult"),
					'145' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "VDRLRPRresultdate"),
					'146' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "poisonGanResult"),
					'147' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "poisonGanResultDate"),
					'148' => UserHelper::getShowDataDay234($dataTab3, "bacsi", "otherComment"),
					'149' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "tentuvanvien"),
					'150' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "date"),
					'151' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "hasHIV"),
					'152' => !empty(UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReason")) ? UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherReasonText"),
					'153' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "HIVdate"),
					'154' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "tenofivirDate"),
					'155' => UserHelper::getShowDataDay234($dataTab3, "tuvanvien3", "otherComment"),
					// Tab 4
					'156' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "tentuvanvien"),
					'157' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "date"),
					'158' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "report_number"),
					'159' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "real_number"),
					'160' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasTieuChay"),
					'161' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasTired"),
					'162' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasPoisonGan"),
					'163' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasChangedEmotion"),
					'164' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasBuonNon"),
					'165' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasManNgua"),
					'166' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasNonMua"),
					'167' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "howManySexFriends"),
					'168' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "howManyAssSexFriends"),
					'169' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasCondomWhenAssSex"),
					'170' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'171' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "hasCocainInLastYear"),
					'172' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien1", "otherComment"),
					'173' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "tenbacsi"),
					'174' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "date"),
					'175' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "fastHIVresult"),
					'176' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "fastHIVresultdate"),
					'177' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "confirmHIVresult"),
					'178' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "confirmHIVresultdate"),
					'179' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "chucnangthanResult"),
					'180' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "chucnangthanResultDate"),
					'181' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "hasSideEffects"),
					'182' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "antiHCVresult"),
					'183' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "antiHCVresultdate"),
					'184' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "VDRLRPRresult"),
					'185' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "VDRLRPRresultdate"),
					'186' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "poisonGanResult"),
					'187' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "poisonGanResultDate"),
					'188' => UserHelper::getShowDataDay234($dataTab4, "bacsi", "otherComment"),
					'189' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "tentuvanvien"),
					'190' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "date"),
					'191' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "hasHIV"),
					'192' => (!empty(UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherReasonText"),
					'193' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "HIVdate"),
					'194' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "tenofivirDate"),
					'195' => UserHelper::getShowDataDay234($dataTab4, "tuvanvien3", "otherComment"),
					// Tab 5
					'196' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "tentuvanvien"),
					'197' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "date"),
					'198' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "report_number"),
					'199' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "real_number"),
					'200' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasTieuChay"),
					'201' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasTired"),
					'202' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasPoisonGan"),
					'203' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasChangedEmotion"),
					'204' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasBuonNon"),
					'205' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasManNgua"),
					'206' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasNonMua"),
					'207' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "howManySexFriends"),
					'208' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "howManyAssSexFriends"),
					'209' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasCondomWhenAssSex"),
					'210' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'211' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "hasCocainInLastYear"),
					'212' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien1", "otherComment"),
					'213' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "tenbacsi"),
					'214' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "date"),
					'215' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "fastHIVresult"),
					'216' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "fastHIVresultdate"),
					'217' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "confirmHIVresult"),
					'218' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "confirmHIVresultdate"),
					'219' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "chucnangthanResult"),
					'220' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "chucnangthanResultDate"),
					'221' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "hasSideEffects"),
					'222' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "antiHCVresult"),
					'223' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "antiHCVresultdate"),
					'224' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "VDRLRPRresult"),
					'225' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "VDRLRPRresultdate"),
					'226' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "poisonGanResult"),
					'227' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "poisonGanResultDate"),
					'228' => UserHelper::getShowDataDay234($dataTab5, "bacsi", "otherComment"),
					'229' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "tentuvanvien"),
					'230' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "date"),
					'231' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "hasHIV"),
					'232' => (!empty(UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherReasonText"),
					'233' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "HIVdate"),
					'234' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "tenofivirDate"),
					'235' => UserHelper::getShowDataDay234($dataTab5, "tuvanvien3", "otherComment"),
					// Tab 6
					'236' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "tentuvanvien"),
					'237' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "date"),
					'238' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "report_number"),
					'239' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "real_number"),
					'240' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasTieuChay"),
					'241' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasTired"),
					'242' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasPoisonGan"),
					'243' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasChangedEmotion"),
					'244' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasBuonNon"),
					'245' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasManNgua"),
					'246' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasNonMua"),
					'247' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "howManySexFriends"),
					'248' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "howManyAssSexFriends"),
					'249' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasCondomWhenAssSex"),
					'250' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'251' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "hasCocainInLastYear"),
					'252' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien1", "otherComment"),
					'253' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "tenbacsi"),
					'254' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "date"),
					'255' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "fastHIVresult"),
					'256' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "fastHIVresultdate"),
					'257' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "confirmHIVresult"),
					'258' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "confirmHIVresultdate"),
					'259' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "chucnangthanResult"),
					'260' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "chucnangthanResultDate"),
					'261' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "hasSideEffects"),
					'262' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "antiHCVresult"),
					'263' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "antiHCVresultdate"),
					'264' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "VDRLRPRresult"),
					'265' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "VDRLRPRresultdate"),
					'266' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "poisonGanResult"),
					'267' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "poisonGanResultDate"),
					'268' => UserHelper::getShowDataDay234($dataTab6, "bacsi", "otherComment"),
					'269' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "tentuvanvien"),
					'270' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "date"),
					'271' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "hasHIV"),
					'272' => (!empty(UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherReasonText"),
					'273' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "HIVdate"),
					'274' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "tenofivirDate"),
					'275' => UserHelper::getShowDataDay234($dataTab6, "tuvanvien3", "otherComment"),
					// Tab 7
					'276' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "tentuvanvien"),
					'277' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "date"),
					'278' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "report_number"),
					'279' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "real_number"),
					'280' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasTieuChay"),
					'281' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasTired"),
					'282' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasPoisonGan"),
					'283' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasChangedEmotion"),
					'284' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasBuonNon"),
					'285' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasManNgua"),
					'286' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasNonMua"),
					'287' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "howManySexFriends"),
					'288' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "howManyAssSexFriends"),
					'289' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasCondomWhenAssSex"),
					'290' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'291' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "hasCocainInLastYear"),
					'292' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien1", "otherComment"),
					'293' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "tenbacsi"),
					'294' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "date"),
					'295' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "fastHIVresult"),
					'296' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "fastHIVresultdate"),
					'297' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "confirmHIVresult"),
					'298' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "confirmHIVresultdate"),
					'299' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "chucnangthanResult"),
					'300' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "chucnangthanResultDate"),
					'301' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "hasSideEffects"),
					'302' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "antiHCVresult"),
					'303' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "antiHCVresultdate"),
					'304' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "VDRLRPRresult"),
					'305' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "VDRLRPRresultdate"),
					'306' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "poisonGanResult"),
					'307' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "poisonGanResultDate"),
					'308' => UserHelper::getShowDataDay234($dataTab7, "bacsi", "otherComment"),
					'309' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "tentuvanvien"),
					'310' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "date"),
					'311' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "hasHIV"),
					'312' => (!empty(UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherReasonText"),
					'313' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "HIVdate"),
					'314' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "tenofivirDate"),
					'315' => UserHelper::getShowDataDay234($dataTab7, "tuvanvien3", "otherComment"),
					// Tab 8
					'316' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "tentuvanvien"),
					'317' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "date"),
					'318' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "report_number"),
					'319' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "real_number"),
					'320' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasTieuChay"),
					'321' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasTired"),
					'322' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasPoisonGan"),
					'323' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasChangedEmotion"),
					'324' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasBuonNon"),
					'325' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasManNgua"),
					'326' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasNonMua"),
					'327' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "howManySexFriends"),
					'328' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "howManyAssSexFriends"),
					'329' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasCondomWhenAssSex"),
					'330' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasAlwaysUseCondomWhenAssSex"),
					'331' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "hasCocainInLastYear"),
					'332' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien1", "otherComment"),
					'333' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "tenbacsi"),
					'334' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "date"),
					'335' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "fastHIVresult"),
					'336' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "fastHIVresultdate"),
					'337' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "confirmHIVresult"),
					'338' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "confirmHIVresultdate"),
					'339' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "chucnangthanResult"),
					'340' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "chucnangthanResultDate"),
					'341' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "hasSideEffects"),
					'342' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "antiHCVresult"),
					'343' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "antiHCVresultdate"),
					'344' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "VDRLRPRresult"),
					'345' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "VDRLRPRresultdate"),
					'346' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "poisonGanResult"),
					'347' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "poisonGanResultDate"),
					'348' => UserHelper::getShowDataDay234($dataTab8, "bacsi", "otherComment"),
					'349' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "tentuvanvien"),
					'350' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "date"),
					'351' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "hasHIV"),
					'352' => (!empty(UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReason"))) ? UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReason") : UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherReasonText"),
					'353' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "HIVdate"),
					'354' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "tenofivirDate"),
					'355' => UserHelper::getShowDataDay234($dataTab8, "tuvanvien3", "otherComment"),
					'356' => $inputs['other_visit']
				]
			];

			$result = $googleSheetHelper->insertRows($userSheetId, $updateRange, $values);

			// Error
			if (!$result) {
				return redirect()->route('user.create')
								->with('fail_message', 'Lỗi hệ thống.Thông tin khách hàng chưa được lưu.')
								->withInput();
			}
			// Log
			Log::info('Create Customer', ["Insert_Values" => $values, "Update_Range" => $updateRange, "Edited_By" => $currentUser]);

			// Set new user id to redirect
			$userId = $nextId;
		}

		// Success
		return redirect()->route('user.update', ['user_id' => $userId])->with('success_message', 'Thông tin khách hàng đã được lưu.');
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
				return redirect()->route('user.list')->with('fail_message', 'Lỗi hệ thống.Không thể xóa được khách hàng.');
			}
		} else {
			return redirect()->route('user.list')->with('fail_message', 'Khách hàng vừa chọn không tồn tại.');
		}

		// Log
		Log::info('Delete Customer', ["Customer_Id" => $user_id, "Deleted_By" => $currentUser]);

		// Success
		return redirect()->route('user.list')->with('success_message', 'Khách hàng đã bị xóa.');
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
