<?php

class MLB_Standings {

    private $url = 'http://erikberg.com/mlb/standings.json';
    private $json;
    private $data;
    private $error = false;
    private $error_code = 0;

    /**
     * Constructor, gets the json file remotely and gets the current standings
     *
     * @return void
     */

    public function __construct() {
        $this->_get_json()->_get_standings();
    }


    /**
     * Set the remote URL for the API call for this instance
     *
     * @param string  $url
     * @return void
     */

    public function set_url( $url ) {
        $this->url = $url;
    }

    /**
     * Get the remote URL for the API call for this instance
     * 
     * @return string 
     */

    public function get_url() {
        return $this->url;
    }


    /**
     * Get the standings data
     *
     * @return array the data
     */

    public function get_data() {
        if ( $this->data ) {
            return $this->data;
        }
    }

    /**
     * Get error
     *
     * @return int|bool if thre's an error, return the error code otherwise return false
     */

    public function get_error() {
        if ( $this->error ) {
            return $this->error_code;
        }
        return false;
    }

    /**
     * Get the data contained in the remote URL for the API call and set the data into an object
     * 
     * @access protected
     * 
     * @return bool true if successful, false if not
     */

    private function _get_json() {
        if ( ! $this->_is_url_valid( $this->url ) ) {
            $this->error_code = 2;
            $this->error = true;
        }
        $file = wp_remote_fopen( $this->url );
        if ( ! $file ) {
            $this->error_code = 3;
            $this->error = true;
        }
        $json = json_decode( $file );
        $this->json = $json;
        return $this;
    }

    /**
     * Get the standings from the json object
     * 
     * @access protected
     * 
     * @return instance of self
     */

    private function _get_standings() {
        $teams = $this->json->standing;
        foreach ( $teams as $team ) {
            $team_name = $team->first_name . ' ' . $team->last_name;
            $won = $team->won;
            $lost = $team->lost;
            $conference = $team->conference;
            $division = $team->division;
            $division_full = strtolower( $conference . $division );
            $streak_type = $team->streak_type;
            $streak_total = $team->streak_total;
            $team_id = $team->team_id;
            $rank = $team->rank;
            $total_games = $won + $lost;
            $games_back = $team->games_back;
            $win_pct = substr( number_format( round( $won/$total_games, 3 ), 3 ), 1 );
            $team_name_short = MLB_Standings_Helper::get_short_name( $team_id );
            $teams_output[$division_full][] = array(
                'rank' => $rank,
                'team-id' => $team_id,
                'name' => $team_name,
                'won' => $won,
                'lost' => $lost,
                'streak-type' => $streak_type,
                'streak-total' => $streak_total,
                'win-pct' => $win_pct,
                'short-name' => $team_name_short,
                'games-back' => $games_back,
            );
        }
        $this->data = $teams_output;
        return $this;
    }



    /**
     * Test if the URL returns 404, 403 or 500
     *
     * @access protected
     *
     * @return bool true if its a valid url, false if not
     */

    private function _is_url_valid() {
        $file_headers = @get_headers( $this->url );
        $invalid_headers = array( '404', '403', '500' );
        if ( ! $file_headers[0] ) {
            $this->error_code = 4;
            $this->error = true;
            return false;
        }
        foreach ( $invalid_headers as $invalid_header ) {
            libxml_use_internal_errors( true );
            if ( strstr( $file_headers[0], $invalid_header ) ) {
                $this->error_code = 5;
                $this->error = true;
                return false;
            }
        }
        return true;
    }


}
