<?php
/*****************************************************/
# Investor
# Page/Class name   : Investor
# Author            :
# Created Date      : 30-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{

	protected $table = 'investors';
	use SoftDeletes;
    protected $dates = ['deleted_at'];


}