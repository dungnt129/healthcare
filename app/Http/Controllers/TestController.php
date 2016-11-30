<?php namespace App\Http\Controllers;

use App\Helpers\GoogleSheet;
use Config;

class TestController extends Controller
{
    public function index() {

		$googleSheetHelper = new GoogleSheet();

		$spreadsheetId = '1h6vG5o51AtNP1cz8BlmKhW78XDCeadM1A0LfyEV1EQw';
		// Get data
		$data = $googleSheetHelper->getSpreadSheetData($spreadsheetId);

		// Update data
		$updateRange = 'Sheet1!A2';
		$values = array(
			array(
				// Cell values ...
				'0' => 1,
				'1' => "Nguyen Dung",
				'2' => "Ha Noi",
				'3' => "0985099040",
				'4' => "Admin",
				'5' => "28/12/2016 10:03:06",
				'6' => "Bình thường nhé",
				'7' => "Cận lòi"
			)
		);

		$result = $googleSheetHelper->updateRows($spreadsheetId, $updateRange, $values);

		// Insert data
		$updateRange = 'Sheet1';
		$values = array(
			array(
				// Cell values ...
				'0' => 6,
				'1' => "Linh",
				'2' => "Ha Noi",
				'3' => "0985099040",
				'4' => "Admin",
				'5' => "28/12/2016 10:03:06",
				'6' => "Bình thường nhé",
				'7' => "Cận lòi"
			)
		);

		$result = $googleSheetHelper->insertRows($spreadsheetId, $updateRange, $values);

		$data = $googleSheetHelper->getSheetData($spreadsheetId);

		$row = 0;
		foreach($data as $key => $customer) {
			if($customer[0] == 3) {
				$row = $key;
			}
		}

		// Delete data
		if($row) {
			$result = $googleSheetHelper->deleteRows($spreadsheetId, $row);
		}

		dd($result);
		die('abc');

		return view('homes.top', [
			'cars'            => $cars
		]);
    }
}