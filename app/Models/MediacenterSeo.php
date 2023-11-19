<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediacenterSeo extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $appends = ['local_created_at'];
}
