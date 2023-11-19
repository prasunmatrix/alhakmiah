<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function module_wise_permissions(){
        return $this->hasMany(Permission::class,'module_name','module_name');
    }
}
