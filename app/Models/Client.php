<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'name', 'email', 'date_of_birth',  'city_id');
    protected $hidden = array('password');
    //protected $appends = array('favourite');

    public function city()
    {
        return $this->belongsTo('City');
    }


    /*public function getIsFav()
    {
        $fav = request()->user()->whereHas('favourites',function($query){

        });
    }*/


    public function posts()
    {
        return $this->belongsToMany('Post');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('BloodType');
    }

    public function notifications()
    {
        return $this->belongsToMany('Notification');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

}
