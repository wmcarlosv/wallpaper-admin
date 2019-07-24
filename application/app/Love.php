<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Love extends Model
{
    protected $table = 'rates';
    protected $fillable = ['device_id','wallpaper_id'];
}
