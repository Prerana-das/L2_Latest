<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','price','quantity'];


    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function tags(){
        return $this->hasMany('App\ProductTag');
    }
}
