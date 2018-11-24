<?php

namespace App\Http\Controllers;

use App\Game;
use App\Stadium;
use App\Team;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function welcome() {

		// Get cURL resource
		$ch = curl_init();

		// Set url
		//curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v2.0/pull/nfl/players.json");
        curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v2.0/pull/nfl/2018-regular/standings.json");
		// Set method
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		// Set options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// Set compression
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");

		// Set headers
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Basic " . base64_encode("09623fd0-c06e-441f-82b1-cfad9b" . ":" . "MYSPORTSFEEDS")
		]);

		// Send the request & save response to $resp
		$resp = curl_exec($ch);
		if (!$resp) {
			die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
		}

		// Close request to clear up some resources
		curl_close($ch);

        $decode = json_decode($resp);
        $some = [];
        foreach ($decode->teams as $team) {

//            Fills stadium table with all teams stadium and avoids duplicates
//            if (!in_array($team->team->homeVenue->name, $some)) {
//                array_push($some, $team->team->homeVenue->name);
//                $stadium = new Stadium;
//                $stadium->name = $team->team->homeVenue->name;
//                $stadium->save();
//            }

//            Fills team table with all the teams in the league
//            $teamDatabase = new Team;
//            $teamDatabase->name = $team->team->name;
//            $teamDatabase->abbreviation = $team->team->abbreviation;
//            $stadiumId = Stadium::where('name', '=', $team->team->homeVenue->name)->get()[0]->id;
//            $teamDatabase->stadium_id = $stadiumId;
//            $teamDatabase->save();
        }

		return view('welcome')->withResources($resp);



	}
}
