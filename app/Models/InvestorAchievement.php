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

class InvestorAchievement extends Model
{

	protected $table = 'investor_achievements';
	use SoftDeletes;
    protected $dates = ['deleted_at'];


}