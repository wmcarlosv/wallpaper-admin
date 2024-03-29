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
            'latest' => $this->api->latest($api_key, $limit),
            'viewed' => $this->api->viewed($api_key, $limit),
            'rated' => $this->api->rated($api_key, $limit)
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

    public function wallpaper_by_category($api_key, $category_id){
    	return $this->responseJson($this->api->wallpapers_by_category($api_key, $category_id));
    }

    public function wallpaper($id){
    	$data = [
    		'wallpaper' => $this->api->wallpaper($id)[0]
    	];

    	return $this->responseJson($data);
    }
}
