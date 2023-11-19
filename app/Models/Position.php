<?php
/*****************************************************/
# Faq
# Page/Class name   : Position
# Author            :
# Created Date      : 13-07-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
	protected $table = 'positions';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['local_created_at'];

    function getCategory()
	{
        return $this->belongsTo('\App\Models\Category' , 'cat_id' , 'id');
	}
}