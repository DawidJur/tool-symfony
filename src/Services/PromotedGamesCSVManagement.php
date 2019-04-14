<?php
namespace App\Services;

use App\Entity\PromotedGames;

class PromotedGamesCSVManagement {
	public $feedback;
	
	public function returnArrayFromFile($file) {
		$i = 0;
		while ($row = fgetcsv($file)) {
			$array[$i]['game'] = $row[0];
			$array[$i]['country'] = $row[2];
			$i++;
		}
		return $array;
	}
	
	public function saveGamesInDatabase($file, $em) {
		$promotedGamesList = $this->returnArrayFromFile($file);
		$time = mktime();
		$feedback = "<h1>Sukces</h1><table>";
		foreach ($promotedGamesList as $pgl) {
			if($pgl['country'] == 'lang_short') { continue; }
			$pg = new PromotedGames();
			$pg->setGameName($pgl['game']);
			$pg->setCountryCode($pgl['country']);
			$pg->setDateOfUpdate($time);
			$em->persist($pg);
			$feedback .= "<tr><td>".$pgl['game']."</td><td>".$pgl['country']."</td></tr>";
		}
		$feedback .= "</table>";
    	$em->flush();
    	$this->feedback = $feedback;
	}

	function __construct($file, $em) {
		$this->saveGamesInDatabase($file, $em);
	}
}