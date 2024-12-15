<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Coupon;
use App\Models\Promo;
use Auth;

use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use \Symfony\Component\DomCrawler\Crawler;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
     
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user_id = \Auth::user()->id;
      $user = \App\Models\User::find($user_id);
       if($user->user_status=='blocked'){
            return view('products.error');
        }
        $data = array();
        $data['title'] = "Products";
        $data['active_product_navbar'] = 'product_active';
        $data['products'] = Promo::all();
        //\App\Libraries\ZnUtilities::pa($data['products']);
        return view('products.list',$data);
    }
    public function productView($slug)
    {
        
        $id = Promo::where('product_slug',$slug)->pluck('promo_id');
//        print_r($id);   die;
        $user_id = \Auth::user()->id;
        $user = \App\Models\User::find($user_id);
        if ($user->user_status == 'blocked') {
            return view('products.error');
        }
        
        $data = array();
        $data['title'] = "Product View";
        $data['product_info'] = Promo::find($id);
        return view('products.singleproduct', $data);
    }
    public function reviewProduct($slug)
 {
        
        $id = Promo::where('product_slug',$slug)->pluck('promo_id');
        $user_id = \Auth::user()->id;
        $user = \App\Models\User::find($user_id);
        if ($user->user_status == 'blocked') {
            return view('products.error');
        }
        $data = array();
        $data['title'] = "Product Review";
        $data['product_info'] = Promo::find($id);

        $chech_coupon = Coupon::where('user_id', \Auth::user()->id)->first();

//        \App\Libraries\ZnUtilities::pa(Auth::user()->id);   die;

        if ($chech_coupon) {
            $coupon_value = $chech_coupon->coupon_code;

//            if ($coupon_value != $coupon_value) {

                $data['coupon_code'] = Coupon::where('promo_id', $id)->where('user_id', '=', '0')->first();

//        if(count($data['coupon_code']) > '0'){

                $assign_coupon = $data['coupon_code'];


//        $coupon_detail = Coupon::where('promo_id',$id)->where('coupon_code',$assign_coupon)->first();
//        $coupon_detail = Coupon::where('coupon_code',$assign_coupon)->first();


                if ($assign_coupon) {
                    $user_id = Auth::user()->id;
                    Coupon::where('coupon_id', $assign_coupon->coupon_id)->update(
                            array
                                (
                                'user_id' => $user_id,
                                'is_reviewed' => '1',
                            )
                    );
                }
//            }
        } else {


            $data['coupon_code'] = Coupon::where('promo_id', $id)->where('user_id', '=', '0')->first();

//        if(count($data['coupon_code']) > '0'){

            $assign_coupon = $data['coupon_code'];


//        $coupon_detail = Coupon::where('promo_id',$id)->where('coupon_code',$assign_coupon)->first();
//        $coupon_detail = Coupon::where('coupon_code',$assign_coupon)->first();


            if ($assign_coupon) {
                $user_id = Auth::user()->id;
                Coupon::where('coupon_id', $assign_coupon->coupon_id)->update(
                        array
                            (
                            'user_id' => $user_id,
                            'is_reviewed' => '1',
                        )
                );
            }
        }

        $data['coupon_code'] = Coupon::where('promo_id', $id)->where('user_id', Auth::user()->id)->first();


        return view('products.reviewproduct', $data);
    }

    public function saveReview($id, ProductRequest $request)
    {
        
        $data = array();
        $data['products'] = Promo::all();
        $review = new Review();
        
        $review->amazon_review = $request->get('review_link');
        $review->promo_id = $id;
        $review->date_submitted_on = date('Y-m-d');
        $review->user_id = Auth::user()->id;
        
        $data['coupon_code'] = Coupon::where('promo_id',$id)->where('user_id','=','0')->first();
        if(count($data['coupon_code']) > '0'){
        $assign_coupon = $data['coupon_code'];        
        $coupon = Coupon::where('coupon_code',$assign_coupon->coupon_code)->first();
        
        $coupon_id = $coupon->coupon_id - 1;
        
        $review->coupon_id = $coupon_id;
        }
        
        $review->save();

       $amazon_review = $review->amazon_review;
        
       $url = $amazon_review;
        
       $html_main = file_get_contents($url);
        $crawler_main = new Crawler($html_main);
        
       
        
        $table_data = $crawler_main->filter('table')->text();
        
        $trim_data = trim($table_data);
        
        $exp = explode('Help other customer', $trim_data);
        
        $strpos = strpos($exp[0],',');
        
        $substr = substr($exp[0], $strpos);
        
        $explode = explode('By',$substr);
        
        $date = $explode[0];        
        $date_correct = substr($explode[0], 2);
        
        $explode_again = explode(':',$substr);
        
        $explode_new = explode(')',$explode_again[1]);        
        $description = trim($explode_new[1]);
        
        $name = substr($explode[1], 2);
        
        $name_expload = explode('.', $name);
        $submitted_by = $name_expload[0];
        
        $result = $explode_again[1];
        
        $product_name = explode(')', $result);      
        $product_name1 = $product_name[0] . ')';
        
        $image = $crawler_main->filter('table > tr > td')->eq(0);
        
        $image1 = $image->filter('span > img')->eq(0)->attr('title');
        
        $review = explode(' ', $image1);
        
        $scrape_data = new \App\Models\Scrape();
        
       
        $scrape_data->submitted_by = $submitted_by;
        $scrape_data->description = $description;
        $scrape_data->product_name = $product_name1;
        $scrape_data->review_star = $review[0];
        $scrape_data->user_id = Auth::user()->id;
        $scrape_data->promo_id = $id;
        $scrape_data->date = date('Y-m-d');
     
        $scrape_data->save();
        
        
        return redirect('products');
    }
    
}
