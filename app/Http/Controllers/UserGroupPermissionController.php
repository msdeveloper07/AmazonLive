<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\UserGroupPermissionController;
use App\Models\UserGroupPermission;
use App\Models\UserGroup;
use App\Models\Permission;
use App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserGroupPermissionRequest;

class UserGroupPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       ZnUtilities::push_js_files('components/userGroupPermission.js');
        
        $data = array();
       
        $usergroup = UserGroup::orderBy('user_group_id','DESC')->get();
       
        $data['usergroup'] = $usergroup;
         $data['title'] = "User Group Permissions";
         
        return view('usergrouppermission.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
   
ZnUtilities::push_js_files('components/userGroupPermission.js');

        
      $data = array();
       $permission = Permission::all();
      
       $usergroup = UserGroup::all();
       
       $userGroupPermissions = UserGrouppermission::all();
        
       $data['permission'] = $permission;
        $data['usergroup'] = $usergroup;
        $data['title'] = "User Group Permissions";
        $data['userGroupPermissions'] = $userGroupPermissions;
       
        return view('usergrouppermission.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGroupPermissionRequest $request)
    {
           $cid = $request->get('user_group_id');
               if($cid){
                   DB::table('user_group_permissions')
                                ->where('user_group_id', $cid)
                                ->delete();
                   
              $cidee = $request->get('cid');
             
               foreach($cidee as $c) 
               {
                   $new = new UsergroupPermission();
                   $new->user_group_id = $cid;
                   $new->permission_id = $c;
                   $new->save();
               } 
       
        return redirect('userGroupPermissions')->with('success','Permissions Changed Successfully');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        ZnUtilities::push_js_files('components/userGroupPermission.js');
        
             $userGroupPermissions = UserGroupPermission::find($id);  
                
            $ugpermission = UserGroupPermission::where('user_group_id',$id)->lists('permission_id')->toArray();
             
        $data = array();    
        $data['id'] = $id;
        $data['usergroup'] = UserGroup::all();
        $data['userGroupPermissions'] = $userGroupPermissions;
        $data['permission'] = Permission::all();
        $data['ugpermission'] = $ugpermission;
         $data['title'] = "User Group Permissions";
//        echo "<pre/>";
//        print_r($data['ugpermission']);
//        die();
       return view('usergrouppermission.edit',$data);
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $cid = $request->get('user_group_id');
              
               if($cid){
                   DB::table('user_group_permissions')
                                ->where('user_group_id', $cid)
                                ->delete();
                   
              $cidee = $request->get('cid');
               foreach($cidee as $c) 
               {
                  
               
        $userGroupPermissions =  new UserGroupPermission;
        $userGroupPermissions->user_group_id = $cid;
        $userGroupPermissions->permission_id = $c;
       
        $userGroupPermissions->save();
        }
               
               }
        
          return Redirect('userGroupPermissions')->with('success','Permissions Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}
