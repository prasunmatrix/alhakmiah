<?php
/*****************************************************/
# Social
# Page/Class name   : Social
# Author            :
# Created Date      : 30-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
        protected $table = 'socials';
        protected $appends = ['local_created_at'];
    
                

}