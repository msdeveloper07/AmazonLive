<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\PermissionsController;
use App\Models\Permission;
use App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PermissionRequest;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
         $data['title'] = "Permissions";
        ZnUtilities::push_js_files('components/permission.js');
        $permission = Permission::orderBy('permission_id','DESC')->get();
        $data['permissions'] = $permission;
        return view('permissions.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       $data = array();
         $data['title'] = 'Permissions';
      
        
       return view('permissions.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        
      
        
        
       $permission = new Permission();
       $title = $request->get('title');
       $element = $request->get('element');
       
      $exist = Permission::where('title',$title)->where('element',$element)->first();
      
      if($exist)
      {
         return Redirect('permissions/create')->with('fail', 'Permmission alredy exist');   
      }
        $permission->component = $request->get('component');
        $permission->title = $request->get('title');
        $permission->element = $request->get('element');
       
        $permission->save();
        
        return Redirect('permissions')->with('success', 'New Permmission Created Successfully!');
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
            $permission= Permission::find($id);  
          
             $data = array();    
        $data['id'] = $id;
        $data['permission'] = $permission;
  
         $data['title'] = "Permissions";
            
       return view('permissions.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::find($id);
       
        $permission->component = $request->get('component');
        $permission->title = $request->get('title');
        $permission->element = $request->get('element');
       
        
        $permission->save();
        
         return Redirect('permissions')->with('success', 'Permmission Updated Successfully!');
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
    
     public function permissionSearch($search)
        {
           
               
               $permission = Permission::where("element","like","%".$search."%")
                           
                            ->paginate(); 
               
               $data = array();
               $data['permissions'] = $permission;
            
         $data['title'] = "Permissions";
                //Basic Page Settings
               
               $data['search'] = $search;

              return view('permissions.list',$data);
              
           
          
        }
        
        public function permissionAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/permissionSearch/'.$search);
            }
            else{
                
                
            //die(Input::get('bulk_action')   );
            
            $cid =$request->get('cid');
            $bulk_action = $request->get('bulk_action');
            if($bulk_action!='')
            {
                switch($bulk_action)
                {
                   
                    case 'delete':
                    {
                        
                        
                        foreach($cid as $id)
                        {
                            DB::table('permissions')
                                ->where('permission_id', $id)
                                ->delete();
                        }
                        
                        return redirect('/permissions')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/permissions')->with('fail','Please Enter a Keyword');
            }
        }
}
