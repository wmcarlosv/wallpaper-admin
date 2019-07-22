<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = ['user_id','name','description','icon','current_version','author','email','website','phone','about','privacy','dev_play_url','publisher_id','banner_id','interstitial_id','interstitial_clicks','one_signal_app_id','one_signal_rest_key','api_key','status'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function categories(){
    	return $this->hasMany('App\Category');
    }

    public function wallpapers(){
    	return $this->hasMany('App\Wallpaper');
    }
}
