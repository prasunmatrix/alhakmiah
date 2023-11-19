<?php
/*****************************************************/
# Country
# Page/Class name   : Country
# Author            :
# Created Date      : 30-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{

   use SoftDeletes;
   protected $dates = ['deleted_at'];
   protected $table = 'countries';

    

}