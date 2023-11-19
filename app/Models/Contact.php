<?php
/*****************************************************/
# Contact
# Page/Class name   : Contact
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

class Contact extends Model
{

    protected $table = 'contacts';
}