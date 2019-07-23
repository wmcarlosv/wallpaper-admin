<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['application_id','name','cover','status'];

    public function application(){
    	return $this->belongsTo('App\Application');
    }
}
