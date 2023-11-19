<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Role,Permission};
use Illuminate\Support\Str;
class RoleController extends Controller
{
    public $data= array();
    public function index(){
        $this->data['page_title']="Role List";
        $this->data['panel_title']="Role List"; 

    $this->data['roles']=Role::orderBy('id','DESC')->get();  
    return view('admin.roles.list', $this->data);
    }
    public function create(){
        $this->data['page_title']="Role Create";
        $this->data['panel_title']="Role Create"; 

        $this->data['modules']=Permission::with(['module_wise_permissions'=>function($q){
            $q->where('is_active',true);
        }])->where('is_active',true)->select('module_name')->distinct()->get();
        
        return view('admin.roles.create',$this->data);
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required|min:2|max:100|unique:roles',
            'permissions'=>'required'
        ]); 

        $role=Role::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'description'=>$request->description,
        ]);
        
        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.roles')->with('success','Role successfully created.');
    }
    public function show(Role $role){

    }
    public function edit(Request $request,$id){
        $this->data['page_title']="Role Edit";
        $this->data['panel_title']="Role Edit"; 

        $this->data['role'] = Role::with(['permissions'])->find($id);
        $this->data['modules']=Permission::with(['module_wise_permissions'=>function($q){
            $q->where('is_active',true);
        }])->where('is_active',true)->select('module_name')->distinct()->get();
        
        return view('admin.roles.edit',$this->data);
    }
    public function update(Role $role,Request $request){
        $request->validate([
            'name'=>'required|min:2|max:100|unique:roles,name,'.$role->id,
            'permissions'=>'required'
        ]); 

        $role->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'description'=>$request->description,
        ]);
        
        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.roles')->with('success','Role successfully updated.');
    }
    public function destroy(Role $role){

    }


    
   

}


