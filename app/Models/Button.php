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

class Button extends Model
{

	protected $table = 'button';
     protected $fillable = ['annual_en','financial_en','profit_en','base_en','annual_ar','financial_ar','profit_ar','base_ar'];


}
