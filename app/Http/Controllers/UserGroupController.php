<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\UserGroup;
use App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserGroupRequest;
use App\Events\AddHistoryEvent;
use Illuminate\Support\Facades\Event;


class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        ZnUtilities::push_js_files('components/userGroup.js');
        
        $data = array();
        
        $usergroup = UserGroup::orderBy('user_group_id','DESC')->get();
        
        $data['usergroup'] = $usergroup;
         $data['title'] = "User Groups";
         
       return view('usergroup.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
         $data['title'] = "User Groups";
           $data['parent_user_groups'] = UserGroup::where('parent_id', '0')->get();
         return view('usergroup.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGroupRequest $request)
    {
        $user = new UserGroup();
        $user->user_group_name = $request->get('user_group_name');
        $user->parent_id = $request->get('user_group_parent_id');
        $user->save();
        
        $history_array = array('title' => 'User Group Saved',
            'content' => '[New] Crete User Group :' . $user->user_group_name,
            'for' => 'User Group',
            'associated_id' => $user->user_group_id,
            'user_id' => \Auth::user()->id,
        );
        Event::fire(new AddHistoryEvent($history_array));
        
         return Redirect('userGroups')->with('success', 'New User Group Created Successfully!');
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
          $usergroup= UserGroup::find($id);  
           
          $data = array();    
        $usergroup = UserGroup::find($id);
        $data['parent_user_groups'] = UserGroup::where('parent_id', '0')->get();


        $data['id'] = $id;
        $data['usergroup'] = $usergroup;
         $data['title'] = "User Groups";
         
       return view('usergroup.edit',$data);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserGroupRequest $request, $id)
    {
         $user = UserGroup::find($id);
        $user->user_group_name = $request->get('user_group_name');
        $user->parent_id = $request->get('user_group_parent_id');
        $user->save();
      
        $history_array = array('title' => 'User Group Update',
            'content' => '[Update] Update User Group :' . $user->user_group_name,
            'for' => 'User Group',
           'associated_id' => $user->user_group_id,
            'user_id' => \Auth::user()->id,
        );
        Event::fire(new AddHistoryEvent($history_array));
        

        return Redirect('userGroups')->with('success', 'User Group Updated Successfully!');
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
    
     public function userGroupSearch($search)
        {
           
               
               $usergroup = UserGroup::where("user_group_name","like","%".$search."%")
                            ->paginate(); 
               
               $data = array();
               $data['usergroup'] = $usergroup;
                $data['title'] = "User Groups";
                //Basic Page Settings
               
               $data['search'] = $search;

              return view('usergroup.list',$data);
              
           
          
        }
        
        public function userGroupAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/userGroupSearch/'.$search);
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
                            DB::table('user_groups')
                                ->where('user_group_id', $id)
                                ->delete();
                        }
                        
                        return redirect('/userGroups')->with('success', 'Rows Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/userGroups')->with('fail','Please Enter a Keyword');
            }
        }
}
