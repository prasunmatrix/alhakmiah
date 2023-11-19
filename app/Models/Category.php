<?php
/*****************************************************/
# Faq
# Page/Class name   : Category
# Author            :
# Created Date      : 13-07-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //protected $appends = ['local_created_at'];
}