<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api;

class ApiController extends Controller
{
	private $api;


	public function __construct(){
		$this->api = new Api();
	}
    public function api_home($api_key = NULL){

        $limit = 10;

        $data = [
            'last' => $this->api->last($api_key, $limit),
            'popular' => $this->api->popular($api_key, $limit),
            'rates' => $this->api->rates($api_key, $limit)
        ];

        return response()
                    ->json($data)
                    ->header('Access-Control-Allow-Origin','*');
    }
}
