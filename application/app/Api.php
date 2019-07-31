<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Api extends Model
{
	public function home_push_data($resource){
        $data = [];
        foreach($resource as $rs){
            $tmp = [
                'id' => $rs->wallpaper_id,
                'category_id' => $rs->category_id,
                'category_name' => $rs->category_name,
                'thumbnail' => env('APP_URL') . 'application/storage/app/'.$rs->thumbnail,
                'wallpaper' => env('APP_URL') . 'application/storage/app/'.$rs->wallpaper_url
            ];
            array_push($data, $tmp);
        }
        return $data;
    }

    public function last($api_key, $limit){
        $last = DB::table("wallpapers")
                ->leftJoin('applications','applications.id','=','wallpapers.application_id')
                ->leftJoin('categories','categories.id','=','wallpapers.category_id')
                ->selectRaw('wallpapers.id as wallpaper_id, categories.id as category_id, categories.name as category_name, wallpapers.thumbnail, wallpapers.wallpaper_url')
                ->where('applications.api_key','=',$api_key)
                ->orderBy('wallpapers.created_at','DESC')
                ->limit($limit)
                ->get();
        return $this->home_push_data($last);
    }

    public function popular($api_key, $limit){
        $popular = DB::table('loves')
            ->leftJoin('wallpapers','loves.wallpaper_id','=','wallpapers.id')
            ->leftJoin('applications','applications.id','=','wallpapers.application_id')
            ->leftJoin('categories','wallpapers.category_id','=','categories.id')
            ->selectRaw('count(loves.wallpaper_id) as loves_qty, categories.id as category_id, categories.name as category_name, wallpapers.thumbnail, wallpapers.wallpaper_url, wallpapers.id as wallpaper_id')
            ->where('applications.api_key','=',$api_key)
            ->groupBy('loves.wallpaper_id','categories.id','categories.name','wallpapers.thumbnail','wallpapers.wallpaper_url','wallpapers.id')
            ->orderBy('loves_qty','DESC')
            ->limit($limit)
            ->get();
        return $this->home_push_data($popular);
    }

    public function rates($api_key, $limit){
        $rates = DB::table('rates')
            ->leftJoin('wallpapers','rates.wallpaper_id','=','wallpapers.id')
            ->leftJoin('applications','applications.id','=','wallpapers.application_id')
            ->leftJoin('categories','wallpapers.category_id','=','categories.id')
            ->selectRaw('sum(rates.stars) as rates_sum, categories.id as category_id, categories.name as category_name, wallpapers.thumbnail, wallpapers.wallpaper_url, wallpapers.id as wallpaper_id')
            ->where('applications.api_key','=',$api_key)
            ->groupBy('rates.wallpaper_id','categories.id','categories.name','wallpapers.thumbnail','wallpapers.wallpaper_url','wallpapers.id')
            ->orderBy('rates_sum','DESC')
            ->limit($limit)
            ->get();
        return $this->home_push_data($rates);
    }

    public function wallpapers($api_key = NULL){
    	$wall = DB::table("wallpapers")
                ->leftJoin('applications','applications.id','=','wallpapers.application_id')
                ->leftJoin('categories','categories.id','=','wallpapers.category_id')
                ->selectRaw('wallpapers.id as wallpaper_id, categories.id as category_id, categories.name as category_name, wallpapers.thumbnail, wallpapers.wallpaper_url')
                ->where('applications.api_key','=',$api_key)
                ->orderBy('wallpapers.created_at','DESC')
                ->get();

        return $this->home_push_data($wall);
    }

    public function categories($api_key = NULL){
    	$categories = [];
    	$result = DB::table("categories")
    					->leftJoin('applications','categories.application_id','=','applications.id')
    					->selectRaw('categories.id as category_id, categories.name as category_name, categories.cover as category_cover')
    					->where('applications.api_key','=',$api_key)
    					->get();

    	foreach($result as $cat){
    		$tmp = [
    			'category_id' => $cat->category_id,
    			'category_name' => $cat->category_name,
    			'category_cover' => env('APP_URL') . 'application/storage/app/' . $cat->category_cover
    		];

    		array_push($categories, $tmp);
    	}

    	return $categories;
    }
}
