<?php
/*****************************************************/
# News
# Page/Class name   : BLog
# Author            :
# Created Date      : 01-04-2022
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  
}
