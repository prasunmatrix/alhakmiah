<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
   
   use SoftDeletes;
   protected $dates = ['deleted_at'];

   function getCity(){
   	return $this->belongsTo('\App\Models\City' , 'city' , 'id'); 
   }

   
}