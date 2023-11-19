<?php
/*****************************************************/
# Faq
# Page/Class name   : Faq
# Author            :
# Created Date      : 30-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{

	protected $table = 'project_faqs';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['local_created_at'];
    
                               
    
    


}