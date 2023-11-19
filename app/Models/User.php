<?php
/*****************************************************/
# User
# Page/Class name   : User
# Author            :
# Created Date      : 15-07-2020
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function getNameAttribute($value){
        return ucfirst($value);
    }
    
    public function roles(){
        return $this->belongsToMany(Role::class);  
    }
  
    public function userPermissionsSlugArray(){
    
    $permissions=[];
    foreach ($this->roles()->with('permissions')->get() as $role) {
        if(count($role->permissions)){
            foreach ($role->permissions as $permission) {
                $permissions[]=$permission->slug;
            }
        }
    }
    return array_unique($permissions);

    }
  
    public function hasAnyPermission(array $permissions){
    foreach ($permissions as $permission) {
        if(in_array($permission, $this->userPermissionsSlugArray())){
            return true;
        }
    }
    return false;

    }
    public function hasAllPermission(array $permissions){
    foreach ($permissions as $permission) {
        if(!in_array($permission, $this->userPermissionsSlugArray())){
            return false;
        }
    }
    return true;
        
    }

    
    

}
