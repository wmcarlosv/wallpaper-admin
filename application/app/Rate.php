<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
    protected $fillable = ['device_id','stars','wallpaper_id'];
}
