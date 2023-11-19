<?php
/*****************************************************/
# State
# Page/Class name   : State
# Author            :
# Created Date      : 30-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{

	protected $table = 'states';
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    

}