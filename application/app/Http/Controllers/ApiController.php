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

	public function responseJson($data){
    	return response()
                    ->json($data)
                    ->header('Access-Control-Allow-Origin','*');
    }

    public function api_home($api_key = NULL){

        $limit = 10;

        $data = [
            'last' => $this->api->last($api_key, $limit),
            'popular' => $this->api->popular($api_key, $limit),
            'rates' => $this->api->rates($api_key, $limit)
        ];

        return $this->responseJson($data);
    }

    public function wallpapers($api_key = NULL){
    	$data = [
    		'wallpapers' => $this->api->wallpapers($api_key)
    	];

    	return $this->responseJson($data);
    }

    public function categories($api_key = NULL){
    	$data = [
    		'categories' => $this->api->categories($api_key)
    	];

    	return $this->responseJson($data);
    }
}
