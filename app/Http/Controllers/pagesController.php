<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function welcome() {

		// Get cURL resource
		$ch = curl_init();

		// Set url
		curl_setopt($ch, CURLOPT_URL, "https://api.mysportsfeeds.com/v2.0/pull/nfl/2018-regular/week/1/player_gamelogs.json?team=det");

		// Set method
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		// Set options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// Set compression
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");

		// Set headers
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Basic " . base64_encode("98236139-7583-41b7-8d26-59e8dd" . ":" . "MYSPORTSFEEDS")
		]);

		// Send the request & save response to $resp
		$resp = curl_exec($ch);
		if (!$resp) {
			die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
		}

		// Close request to clear up some resources
		curl_close($ch);

		return view('welcome')->withResources($resp);

	}
}
