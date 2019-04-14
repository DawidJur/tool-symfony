<?php
namespace App\Services;

class PromotedGamesView {
	public $newsGames;
	private $games_array;

	private function returnSection($countryCode) {
		$german = ['de', 'at'];
		$russian = ['ru', 'ua', 'kz', 'by'];
		$polish = ['pl'];
		$italian = ['it'];
		$spanish = ['es'];
		$french = ['fr'];

		if(in_array($countryCode, $german)) {
			return "German";
		}elseif(in_array($countryCode, $russian)) {
			return "Russian";
		}elseif(in_array($countryCode, $polish)) {
			return "Polish";
		}elseif(in_array($countryCode, $italian)) {
			return "Italian";
		}elseif(in_array($countryCode, $spanish)) {
			return "Spanish";
		}elseif(in_array($countryCode, $french)) {
			return "French";
		}else {
			return "Global";
		}
	}

	private function getNews() {
		$sections = [];
		$games = [];

		foreach($this->games_array as $row) {
			$news[$this->returnSection($row['country_code'])][] = $row['game_name'];
			$sections[] = $this->returnSection($row['country_code']); 
		}

		$sections = array_unique($sections);
		foreach ($sections as $value) {
			$games[$value] = array_unique($news[$value]);
		}
		$this->newsGames = $games;
		return $games;
	}

	private function isInSection($section, $game) {
		if(@in_array($game,$this->newsGames[$section])) {
			return "<b>Yes</b>";
		}else {
			return "no";
		}
	}

	public function printGames() {
		$gamesPerCountry = $this->getNews();
		$gamesUnique = [];
		foreach ($gamesPerCountry as $key => $games) {
			foreach($games as $game) {
				$gamesUnique[] = $game;
			}			
		}

		$gamesUnique = array_unique($gamesUnique);
		sort($gamesUnique);
	
		$view = "<table>";
		$view .= "<tr><th>Game</th><th>EN</th><th>PL</th><th>DE</th><th>FR</th><th>IT</th><th>ES</th><th>RU</th></tr>";
		foreach ($gamesUnique as $key => $value) {
			$view .= "<tr>";
			$view .= "<td>$value</td>";
			$view .= "<td>".$this->isInSection('Global', $value)."</td>";
			$view .= "<td>".$this->isInSection('Polish', $value)."</td>";
			$view .= "<td>".$this->isInSection('German', $value)."</td>";
			$view .= "<td>".$this->isInSection('French', $value)."</td>";
			$view .= "<td>".$this->isInSection('Italian', $value)."</td>";
			$view .= "<td>".$this->isInSection('Spanish', $value)."</td>";
			$view .= "<td>".$this->isInSection('Russian', $value)."</td>";
			$view .= "</tr>";

		}
		$view .= "</table>";

		if($gamesUnique == null) { 
			$view = 'There is no any games in this month'; 
		}

		$this->view = $view;
		return $view;
	} 
	
	function __construct($games_array) {
		$this->games_array = $games_array;
	}
}