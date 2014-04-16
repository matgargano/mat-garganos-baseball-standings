<?php


class MLB_Standings_Helper {
	
	/**
	 * Get shortened team name
	 * 
	 * Filter: mgbs_shorten_name - allows you to specify your own team name shortening
	 * 
	 * @param string $team_id the ID of the team
	 * @return string shortened team name
	 */


	public static function get_short_name( $team_id ){

		$array = apply_filters( 'mgbs_shorten_name', array(
			'detroit-tigers' => 'DET',
			'chicago-white-sox' => 'CHA',
			'minnesota-twins' => 'MIN',
			'cleveland-indians' => 'CLE',
			'kansas-city-royals'	 => 'KCA',
			'toronto-blue-jays'	 => 'TOR',
			'new-york-yankees' => 'NYA',
			'tampa-bay-rays' => 'TBA',
			'baltimore-orioles' => 'BAL',
			'boston-red-sox' => 'BOS',
			'oakland-athletics'	 => 'OAK',
			'seattle-mariners' => 'SEA',
			'texas-rangers' => 'TEX',
			'los-angeles-angels' => 'LAA',
			'houston-astros' => 'HOU',
			'milwaukee-brewers' => 'MIL',
			'st-louis-cardinals'	 => 'SLN',
			'pittsburgh-pirates' => 'PIT',
			'cincinnati-reds' => 'CIN',
			'chicago-cubs' => 'CHN',
			'atlanta-braves' => 'ATL',
			'washington-nationals' => 'WAS',
			'new-york-mets' => 'NYN',
			'philadelphia-phillies' => 'PHI',
			'miami-marlins' => 'FLN',
			'los-angeles-dodgers' => 'LAN',
			'san-francisco-giants' => 'SFN',
			'colorado-rockies'	 => 'COL',
			'san-diego-padres' => 'SDN',
			'arizona-diamondbacks' => 'ARI',
			) 
		);
		return $array[ $team_id ];
	}
}