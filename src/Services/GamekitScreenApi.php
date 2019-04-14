<?php
namespace App\Services;

class GamekitScreenApi {
	private $DogryAPI = "";
	private $GamekitAPI = ""; //links to api

	public $DogryDateDelay;
	public $DogryNumberOfScreens;
	public $GamekitDateDelay;
	public $GamekitNumberOfScreens;
	public $dateNow;

	private function getAPIObject() {
		$jsonDogry = file_get_contents($this->DogryAPI);
		$objDogry = json_decode($jsonDogry);
		$jsonGamekit = file_get_contents($this->GamekitAPI);
		$objGamekit = json_decode($jsonGamekit);
		$bothObjects['Dogry'] = $objDogry;
		$bothObjects['Gamekit'] = $objGamekit;
		return $bothObjects;
	}

	function __construct() {
		$feedback = $this->getAPIObject();
		$dateNow = mktime();

		if($feedback['Dogry']->oldestScreenshotDate != null) {
			$this->DogryDateDelay = strtotime($feedback['Dogry']->oldestScreenshotDate);
		} else {
			$this->DogryDateDelay = $dateNow;
		}
		$this->DogryNumberOfScreens = $feedback['Dogry']->notModeratedCount;

		if($feedback['Gamekit']->oldestScreenshotDate != null) {
			$this->GamekitDateDelay = strtotime($feedback['Gamekit']->oldestScreenshotDate);
		} else{
			$this->GamekitDateDelay = $dateNow;
		}
		$this->GamekitNumberOfScreens = $feedback['Gamekit']->notModeratedCount;

		$this->dateNow = $dateNow;
	}
}