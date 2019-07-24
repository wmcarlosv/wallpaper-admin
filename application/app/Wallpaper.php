<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallpaper extends Model
{
    protected $table = 'wallpapers';
    protected $fillable = ['application_id','category_id','thumbnail','wallpaper_url','tags','status'];

    public function application(){
    	return $this->belongsTo('App\Application');
    }

    public function category(){
    	return $this->belongsTo('App\Category');
    }
}
