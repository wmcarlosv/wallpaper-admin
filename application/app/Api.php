<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Api extends Model
{
    private $media_url;

    public function __construct(){
        $this->media_url = env('APP_URL') . 'application/storage/app/';
    }

    public function latest($api_key, $limit){   
        $latest = DB::select(DB::raw('select wall.id as wallpaper_id,cat.id as category_id, 
                    cat.name as category_name, concat("'.$this->media_url.'",wall.thumbnail) as thumbnail, concat("'.$this->media_url.'",wall.wallpaper_url) as wallpaper_url, 
                    wall.tags from wallpapers as wall
                    inner join applications as app on (app.id = wall.application_id)
                    inner join categories as cat on (cat.id = wall.category_id)
                    where app.api_key = "'.$api_key.'"
                    order by wall.created_at DESC limit '.$limit));
        return $latest;
    }

    public function viewed($api_key, $limit){
        $viewed = DB::select(DB::raw('select wall.id as wallpaper_id,cat.id as category_id, 
                cat.name as category_name, concat("'.$this->media_url.'",wall.thumbnail) as thumbnail, concat("'.$this->media_url.'",wall.wallpaper_url) as wallpaper_url, 
                wall.tags from loves as lov 
                inner join wallpapers as wall on (wall.id = lov.wallpaper_id)
                inner join applications as app on (app.id = wall.application_id)
                inner join categories as cat on (cat.id = wall.category_id)
                where app.api_key = "'.$api_key.'"
                group by wall.id, cat.id, cat.name, wall.thumbnail, wall.wallpaper_url, wall.tags
                order by count(lov.wallpaper_id) DESC limit '.$limit));
        return $viewed;
    }

    public function rated($api_key, $limit){
        $rated = DB::select(DB::raw('select wall.id as wallpaper_id, cat.id as category_id, 
                    cat.name as category_name, concat("'.$this->media_url.'",wall.thumbnail) as thumbnail, concat("'.$this->media_url.'",wall.wallpaper_url) as wallpaper_url, 
                    wall.tags from rates as rat
                    inner join wallpapers as wall on (wall.id = rat.wallpaper_id)
                    inner join applications as app on (app.id = wall.application_id)
                    inner join categories as cat on (cat.id = wall.category_id)
                    where app.api_key = "'.$api_key.'"
                    group by wall.id, cat.id, cat.name, wall.thumbnail, wall.wallpaper_url, wall.tags
                    order by count(rat.wallpaper_id) DESC limit '.$limit));
        return $rated;
    }

    public function wallpapers($api_key = NULL){
    	$wallpapers = DB::select(DB::raw('select wall.id as wallpaper_id,cat.id as category_id, 
                    cat.name as category_name, concat("'.$this->media_url.'",wall.thumbnail) as thumbnail, concat("'.$this->media_url.'",wall.wallpaper_url) as wallpaper_url, 
                    wall.tags from wallpapers as wall
                    inner join applications as app on (app.id = wall.application_id)
                    inner join categories as cat on (cat.id = wall.category_id)
                    where app.api_key = "'.$api_key.'"
                    order by wall.created_at DESC'));
        return $wallpapers;
    }

    public function categories($api_key = NULL){
        $categories = DB::select(DB::raw('select cat.id as category_id, cat.name as category_name, concat("'.$this->media_url.'",cat.cover) as category_cover from categories as cat inner join applications as app on (app.id = cat.application_id) where app.api_key = "'.$api_key.'"'));
    	return $categories;
    }

    public function wallpapers_by_category($api_key = NULL, $category_id = NULL){
    	$category = DB::select(DB::raw('select * from categories where id = '.$category_id));

    	$wallpapers = DB::select(DB::raw('select wall.id as wallpaper_id,cat.id as category_id, 
                    cat.name as category_name, concat("'.$this->media_url.'",wall.thumbnail) as thumbnail, concat("'.$this->media_url.'",wall.wallpaper_url) as wallpaper_url, 
                    wall.tags from wallpapers as wall
                    inner join applications as app on (app.id = wall.application_id)
                    inner join categories as cat on (cat.id = wall.category_id)
                    where app.api_key = "'.$api_key.'" and cat.id = '.$category_id.'
                    order by wall.created_at DESC'));

        return ['category' => $category, 'wallpapers' => $wallpapers];
    }

    public function wallpaper($id){
    	$wallpaper = DB::select(DB::raw('select wall.id as wallpaper_id,cat.id as category_id, 
                    cat.name as category_name, concat("'.$this->media_url.'",wall.thumbnail) as thumbnail, concat("'.$this->media_url.'",wall.wallpaper_url) as wallpaper_url, 
                    wall.tags from wallpapers as wall
                    inner join categories as cat on (cat.id = wall.category_id)
                    where wall.id = '.$id));
        return $wallpaper;
    }
}