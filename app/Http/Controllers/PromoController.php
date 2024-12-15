<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PromoRequest;
use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\History;
use App\Models\CouponBatch;
use App\Models\Coupon;

use Illuminate\Database\Eloquent\Collection;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailTemplate;
class PromoController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        ZnUtilities::push_js_files('components/promos.js');
        $data = array();
        $data['active_promo_navbar'] = 'promo_active';
        $data['promos'] = Promo::orderBy('promo_id', 'DESC')->paginate('10');
        $data['title'] = "Promos";
        return view('promo.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        
        $data = array();
        $data['title'] = "Promos";
         $data['email_templates'] = EmailTemplate::where('promo_id',0)->orderBy('order','ASC')->get();
        
        
        return view('promo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoRequest $request) {
        $activation_code = ZnUtilities::random_string('alphanumeric', '50');
        $promo = new Promo();

        $pro_img = $request->file('file');
        if ($pro_img) {
            $destinationPathImg = "product_image/";
            $temp_nameImg = $pro_img->getClientOriginalName();
            $pro_img->move($destinationPathImg, $temp_nameImg);
            $promo->product_image = $temp_nameImg; 
        }
        $promo->promo_name = $request->get('promo_name');
        
        $promo_title = $request->get('promo_name');
        $promo_slug = ZnUtilities::getSlug($promo_title, $promo, 'promo_slug', 'promo_id');
        $promo->promo_slug = $promo_slug;
        
        $promo->aisn = $request->get('aisn');
        $promo->promo_status = $request->get('status');
    
        $promo->sales_price = $request->get('sales_price');
        $promo->normal_price = $request->get('normal_price');
        $promo->product_title = $request->get('product_title');
        $promo->product_link = $request->get('product_link');
  
        $product_title = $request->get('product_title');
        $product_slug = ZnUtilities::getSlug($product_title, $promo, 'product_slug', 'promo_id');
        $promo->product_slug = $product_slug;
        
       
        
        $promo->promo_description = $request->get('description');
        $promo->landing_page_des = $request->get('landing_page_des');                
        $promo->created_at = date('Y-m-d');
        $promo->save();

        $batch_file = new CouponBatch();

        $file = $request->file('batch_file');
//        ZnUtilities::pa($file);die;
        if ($file) {
            $destinationPath = "batch_file/";
            $temp_name = $file->getClientOriginalName();
            $pos = strpos($temp_name, '.');
            $file_name = substr($temp_name, 0, $pos);

            $file->move($destinationPath, $file_name);
            $batch_file->code_prefix = $file_name;

            $batch_file->date_imported = date('Y-m-d');
            $batch_file->promo_id = $promo->promo_id;

            $coupon_file = file_get_contents($destinationPath . $file_name);
            $zc = urlencode($coupon_file);
            $coupon_file_explode = explode('%0D%0A', $zc);
            $filter_coupon = array_filter($coupon_file_explode);
            $coupon_count = count($filter_coupon);

            $batch_file->count = $coupon_count;
            $batch_file->save();

            foreach ($filter_coupon as $fc) {
                
                $duplicate = Coupon::where('coupon_code', $fc)->where('user_id','>','0')->first();
                if (count($duplicate) != '1') {
                $coupon = new Coupon();
                $coupon->coupon_code = $fc;
                $coupon->promo_id = $promo->promo_id;
                $coupon->coupon_batch_id = $batch_file->coupon_batch_id;

                $coupon->date_send_on = date('Y-m-d');

                $coupon->save();
            }
            }
        }


        return redirect('promos')->with('success', 'Promo Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {

        $id = Promo::where('promo_slug',$slug)->pluck('promo_id');
        $promo = Promo::find($id);

        $data = array();
        $data['id'] = $id;
        $data['promo'] = $promo;   
        $data['title'] = "Promos";
        $data['email_templates'] = EmailTemplate::where('promo_id',$id)->orderBy('order','ASC')->get();
        $data['coupon_batch'] = CouponBatch::where('promo_id',$id)->get();
        
        $data['coupon'] = Coupon::where('promo_id',$id)->lists('promo_id');
        
       
        
        $data['generate_coupon'] = Coupon::where('promo_id',$id)->where('user_id','!=','0')->lists('promo_id');
        
        $data['pending_coupon'] = Coupon::where('promo_id',$id)->where('user_id','=','0')->lists('promo_id');
        
//        ZnUtilities::pa(count($generate));  die;
        
        return view('promo.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug, PromoRequest $request) {  
       
        $id = Promo::where('promo_slug',$slug)->pluck('promo_id');
        $promo = Promo::find($id);
        
//        print_r($request->get('product_link'));
           
        $promo->promo_name = $request->get('promo_name'); 
        $promo->aisn = $request->get('aisn'); 
        $promo->promo_status = $request->get('status'); 
    
        $promo->sales_price = $request->get('sales_price'); 
        $promo->normal_price = $request->get('normal_price'); 
        $promo->product_title = $request->get('product_title'); 
        $promo->product_link = $request->get('product_link');
        $promo->promo_description = $request->get('description');              
        $promo->landing_page_des = $request->get('landing_page_des');              
        
        
        $product_img = $request->file('file');
        if($product_img){
        $destinationPathImg = "product_image/";
        $temp_nameImg = $product_img->getClientOriginalName();
        $product_img->move($destinationPathImg, $temp_nameImg);
        $promo->product_image = $temp_nameImg;

        
        }
        $promo->save();
        
        $coupon_batch_id = CouponBatch::where('promo_id',$id)->first();
      
     
        
        if(isset($coupon_batch_id->coupon_batch_id)){
        
//              ZnUtilities::pa($request->file('batch_file'));  die;
        
            $batch_file = CouponBatch::find($coupon_batch_id->coupon_batch_id);
            
            $file = $request->file('batch_file'); 
            if($file){
            $destinationPath = "batch_file/";
            $temp_name = $file->getClientOriginalName();
            $pos = strpos($temp_name, '.');
            $file_name = substr($temp_name, 0, $pos);
            $file->move($destinationPath, $file_name);
           
            $batch_file->code_prefix = $file_name;

            $batch_file->date_imported = date('Y-m-d');
            $batch_file->promo_id = $promo->promo_id;
            
            $coupon_file = file_get_contents($destinationPath.$file_name);           
            $zc = urlencode($coupon_file);           
            $coupon_file_explode = explode('%0D%0A', $zc);  
            $filter_coupon = array_filter($coupon_file_explode);
            $coupon_count = count($filter_coupon);
            
            $batch_file->count = $coupon_count;
            $batch_file->save();
            

            Coupon::where('promo_id', $id)->where('user_id', '=', '0')->delete();

            $coupon_id = Coupon::where('promo_id',$id)->lists('coupon_id');
            
//            ZnUtilities::pa($coupon_id);  die;
            
//            foreach ($coupon_id as $c_id) {
               foreach ($filter_coupon as $fc) {
                $coupon = new Coupon();


                $duplicate = Coupon::where('coupon_code', $fc)->where('user_id','>','0')->first();
                if (count($duplicate) != '1') {
                    $coupon->coupon_code = $fc;
                    $coupon->promo_id = $promo->promo_id;
                    $coupon->coupon_batch_id = $batch_file->coupon_batch_id;
                    $coupon->date_send_on = date('Y-m-d');
                    $coupon->save();
                }
            }
            }
        }
        else{

        
        $file = $request->file('batch_file'); 
            if($file){
//        ZnUtilities::pa($file);  die;
            $batch_file = new CouponBatch();
        
            $destinationPath = "batch_file/";
            $temp_name = $file->getClientOriginalName();
            $pos = strpos($temp_name, '.');
            $file_name = substr($temp_name, 0, $pos);
            $file->move($destinationPath, $file_name);
           
            $batch_file->code_prefix = $file_name;

            $batch_file->date_imported = date('Y-m-d');
            $batch_file->promo_id = $promo->promo_id;
            
            $coupon_file = file_get_contents($destinationPath.$file_name);           
            $zc = urlencode($coupon_file);           
            $coupon_file_explode = explode('%0D%0A', $zc);  
            $filter_coupon = array_filter($coupon_file_explode);
            $coupon_count = count($filter_coupon);
            
            $batch_file->count = $coupon_count;
            $batch_file->save();
            
            
            Coupon::where('promo_id', $id)->where('user_id', '=', '0')->delete();

            $coupon_id = Coupon::where('promo_id',$id)->lists('coupon_id');
            
//            ZnUtilities::pa($coupon_id);  die;
            
//            foreach ($coupon_id as $c_id) {
               foreach ($filter_coupon as $fc) {
                $coupon = new Coupon();


                $duplicate = Coupon::where('coupon_code', $fc)->where('user_id','>','0')->first();
                if (count($duplicate) != '1') {
                    $coupon->coupon_code = $fc;
                    $coupon->promo_id = $promo->promo_id;
                    $coupon->coupon_batch_id = $batch_file->coupon_batch_id;
                    $coupon->date_send_on = date('Y-m-d');
                    $coupon->save();
                }
            }
            
            
        }
        }
        
        
        

        return Redirect('promos')->with('success', 'Promo Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function promoSearch($search) {


        $promo = Promo::where("promo_name", "like", "%" . $search . "%")
                ->orWhere("aisn", "like", "%" . $search . "%")
                ->paginate();

        $data = array();
        $data['promos'] = $promo;
        //Basic Page Settings

        $data['search'] = $search;
        $data['title'] = "Promos";

        return view('promo.list', $data);
    }


    public function promoAction(Request $request) {


        $search = $request->get('search');
        if ($search != '') {
            return redirect('/promoSearch/' . $search);
        } else {


            //die(Input::get('bulk_action')   );

            $cid = $request->get('cid');
            $bulk_action = $request->get('bulk_action');
            if ($bulk_action != '') {
                switch ($bulk_action) {
                    case 'blocked': {
                            foreach ($cid as $id) {
                                DB::table('promos')
                                        ->where('id', $id)
                                        ->update(array('promo_status' => 'deactive'));
                            }

                            return redirect('/promos')->with('success', 'Rows Updated!');

                            break;
                        }
                    case 'active': {
                            foreach ($cid as $id) {
                                DB::table('promos')
                                        ->where('id', $id)
                                        ->update(array('promo_status' => 'active'));
                            }

                            return redirect('/promos')->with('success', 'Rows Updated!');
                            break;
                        }
                    case 'delete': {


                            foreach ($cid as $id) {
                                DB::table('promos')
                                        ->where('id', $id)
                                        ->delete();
                            }

                            return redirect('/promos')->with('success', 'Row Deleted Successfully!');
                            break;
                        }
                } //end switch
            } // end if statement
            return redirect('/promos')->with('fail', 'Please Enter a Keyword');
        }
    }
  public function emailTemplate($id,$promo_id = null) {
        if($promo_id == null){
            $temp = EmailTemplate::all();
        }else{
             $temp = EmailTemplate::where('promo_id',$promo_id)->orderBy('order','ASC')->get();
        }
        
        
        $data = array();
        $data['id'] = $id;
        $data['promo_id'] = $promo_id;
        
        $data['emailTemplates'] = $temp;   
        $data['title'] = "Email Template";
//        $data['coupon_batch'] = CouponBatch::where('promo_id',$id)->get();
//       
        
        return view('promo.email_template', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function emailTemplateSave($id,$promo_id = null, Request $request ) {  

//        $templates_old = EmailTemplate::where('promo_id',$promo_id)->get();
//        foreach($templates_old as $d){
//           EmailTemplate::where('promo_id', $promo_id)->where('email_template_id', $d->email_template_id)->delete();
//        }
        if($promo_id == null){
       $temp_id_array = $request->get('temp_ids');
        $template =  EmailTemplate::find($temp_id_array[0]);
        $template->email_template_title = $request->get('email_subject'); 
        
        
        $template->content = $request->get('email_content_1'); 
        
//        $template->promo_id = '';
        $template->sent = '';
        $template->time_delay = 0;
        $template->order = 1;
        
        $product_img = $request->file('file');
        if($product_img){
        $destinationPathImg = "emailTemplateImages/";
        $temp_nameImg = $product_img->getClientOriginalName();
        $product_img->move($destinationPathImg, $temp_nameImg);
        $template->attachment = $temp_nameImg;

        }
        $template->save();
        
       $template2 = EmailTemplate::find($temp_id_array[1]);
        $template2->email_template_title = $request->get('email_subject'); 
        
     
        $template2->content = $request->get('email_content_2'); 
            
//        $template2->promo_id = '';
        $template2->sent = '';
        $template2->time_delay = 8;
         $template->order = 2;
           $template2->attachment = isset($temp_nameImg)?$temp_nameImg:'';
        
        $template2->save();
        
        
        $template3 = EmailTemplate::find($temp_id_array[2]);
        $template3->email_template_title = $request->get('email_subject'); 
        
        
        $template3->content = $request->get('email_content_3'); 
        
//        $template3->promo_id = '';
        $template3->sent = '';
        $template3->time_delay = 15;
         $template->order = 3;
           $template3->attachment =  isset($temp_nameImg)?$temp_nameImg:'';
        
       
        $template3->save();
            
         }else{
             $temp_id_array = $request->get('temp_ids');
        $template =  EmailTemplate::find($temp_id_array[0]);
        $template->email_template_title = $request->get('email_subject'); 

        
        $template->content = $request->get('email_content_1'); 
        
        $template->promo_id = $promo_id;
        $template->sent = '';
        $template->time_delay = 0;
        $template->order = 1;
        
        $product_img = $request->file('file');
        if($product_img){
        $destinationPathImg = "emailTemplateImages/";
        $temp_nameImg = $product_img->getClientOriginalName();
        $product_img->move($destinationPathImg, $temp_nameImg);
        $template->attachment = $temp_nameImg;
        
        }
        $template->save();
        
       $template2 = EmailTemplate::find($temp_id_array[1]);
        $template2->email_template_title = $request->get('email_subject'); 
        
        
        $template2->content = $request->get('email_content_2'); 
        
        $template2->promo_id = $promo_id;
        $template2->sent = '';
        $template2->time_delay = 8;
         $template->order = 2;
           $template2->attachment = isset($temp_nameImg)?$temp_nameImg:'';
        
        $template2->save();
        
        
        $template3 = EmailTemplate::find($temp_id_array[2]);
        $template3->email_template_title = $request->get('email_subject'); 
        
        
        $template3->content = $request->get('email_content_3'); 
        
        $template3->promo_id = $promo_id;
        $template3->sent = '';
        $template3->time_delay = 15;
         $template->order = 3;
           $template3->attachment =  isset($temp_nameImg)?$temp_nameImg:'';
        
       
        $template3->save();
         }

        return Redirect()->back()->with('success', 'Email Template Updated Successfully');
    }
    


}
