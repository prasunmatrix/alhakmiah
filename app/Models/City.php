<?php
/*****************************************************/
# City
# Page/Class name   : City
# Author            :
# Created Date      : 30-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

	protected $table = 'cities';
	use SoftDeletes;
    protected $dates = ['deleted_at'];

	public function getCountry(){

        return $this->hasOne('\App\Models\Country', 'id','country_id');
    }
    public function getState(){

        return $this->hasOne('\App\Models\State', 'id','state_id');
    }

    

}