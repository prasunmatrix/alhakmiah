<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded=[];
    public function permissions(){
        return $this->belongsToMany(Permission::class);  
    }

    public function permissionsIdsArray(){
        $permission_id=[];
        if(count($this->permissions)){
            foreach ($this->permissions as $permission) {
                $permission_id[]=$permission->id;
            }
        }
        return  $permission_id;
    }

}
