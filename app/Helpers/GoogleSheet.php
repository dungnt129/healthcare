<?php
namespace App\Helpers;

use Cache;
use Config;

/**
 *
 * Google Sheet Class
 *
 * @todo call Google Sheet API
 * @author DungNT
 *
 */
class GoogleSheet {

	/**
     * @var system_model Singleton instance
     */
    protected static $_instance;

	protected $client;

	protected $service;

	protected $timezone;

	function __construct() {
		$this->timezone = Config::get('app.timezone');

		/* Get google credential */
		$json_file_location = Config::get('google.credential_file_location');

		$this->client = new \Google_Client();
		$this->client->setApplicationName("HealthCare System");
		$this->service = new \Google_Service_Sheets($this->client);

		/* If we have an access token */
		if (Cache::has('service_token')) {
		  $this->client->setAccessToken(Cache::get('service_token'));
		}

		$scopes = array('https://www.googleapis.com/auth/spreadsheets');
		// Set Auth config
		$this->client->setAuthConfig($json_file_location);
		$this->client->setScopes($scopes);

		// Skip verify https on local
//		$this->client->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));

		// Refresh access token if expired
		if ($this->client->isAccessTokenExpired()) {
			$this->client->refreshTokenWithAssertion();
		}

		Cache::forever('service_token', $this->client->getAccessToken());
	}

	/**
     * Get singletom instance
     * @return App\Helpers\GoogleSheet
     */
    public final static function getInstance()
    {
        //Check instance
        if (is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        //Return instance
        return self::$_instance;
    }

	/**
	 * Get Spread Sheet Data
	 *
	 * @param string $spreadsheetId
	 * @param string $range
	 * @return array
	 */
	public function getSpreadSheetData($spreadsheetId, $range = 'Sheet1') {
		$results = [];

		try {
			$results = $this->service->spreadsheets_values->get($spreadsheetId, $range);

			if($results) {
				return $results->getValues();
			}

		} catch (Exception $e) {
			return $results;
		}

		return $results;
	}

	/**
	 * Update SpreadSheet Data
	 *
	 * @param string $spreadsheetId
	 * @param string $range
	 * @param array $values
	 * @return array
	 */
	public function updateRows($spreadsheetId, $range = 'Sheet1', $values) {
		$results = false;

		try {

			$body = new \Google_Service_Sheets_ValueRange(array(
			  'values' => $values
			));
			// Determines how input data should be interpreted.
			// https://developers.google.com/sheets/reference/rest/v4/ValueInputOption
			$params = array(
			  'valueInputOption' => 'RAW'
			);

			$results = $this->service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);

		} catch (Exception $e) {
			return $results;
		}

		return $results;
	}

	/**
	 * Insert SpreadSheet Data
	 *
	 * @param string $spreadsheetId
	 * @param string $range
	 * @param array $values
	 * @return array
	 */
	public function insertRows($spreadsheetId, $range = 'Sheet1', $values) {
		$results = false;

		try {

			$body = new \Google_Service_Sheets_ValueRange(array(
			  'values' => $values
			));

			// Determines how input data should be interpreted.
			// https://developers.google.com/sheets/reference/rest/v4/ValueInputOption
			$params = array(
			  'valueInputOption' => 'RAW'
			);
			$results = $this->service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

		} catch (Exception $e) {
			return $results;
		}

		return $results;
	}

	public function deleteRows($spreadsheetId, $row) {
		$results = false;

		try {

			$requests = array();

			/*
			 *  Delete row
			 *   https://developers.google.com/sheets/guides/batchupdate
			 *   https://developers.google.com/sheets/samples/rowcolumn
			 *
			 */
			$requests[] = new \Google_Service_Sheets_Request(array(
				'deleteDimension' => array(
					'range' => array(
						'sheetId' => 0,
						'dimension' => 'ROWS',
						'startIndex' => $row,
						'endIndex' => $row + 1
					)
				)
			));

			$batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
				'requests' => $requests
			));

			$results = $this->service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);

		} catch (Exception $e) {
			return $results;
		}

		return $results;
	}
}