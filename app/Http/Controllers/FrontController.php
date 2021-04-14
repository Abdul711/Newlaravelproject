<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Mail;
use \PDF;
use \FPDF;
use Str;
class FrontController extends Controller
{
     
     public function index(){
        $data=DB::table('brands')->where(['status'=>'1'])->where(['show_at_home'=>'1'])->get();
        $data_c=DB::table('categories')->where(['status'=>'1'])->where(['category_show'=>'1'])->where(['parent_category_id'=>'0'])->get();
        $data_banner=DB::table('banners')->where(['status'=>'1'])->get();
  /*select('categories.category_name','sub_categories.status','sub_categories.sub_category_name',
  'sub_categories.id','sub_categories.created_at')*/
     $result['brands']=$data;      
     $result['banners']=$data_banner;   
     $result['categories']=$data_c;   

    foreach($result['categories'] as $list){
     $result['home_categories_product'][$list->id]=
     DB::table('products')
     ->leftJoin("brands","brands.id","=","products.brand_id")
     ->select('products.*','brands.brands')
     ->where(['products.status'=>1])
     ->where(['products.category_id'=>$list->id])
     ->get();
  
        foreach($result['home_categories_product'][$list->id] as $list1){
            $result['home_product_attributes'][$list1->id]=
            DB::table('product_attributes')
            ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
 
            ->leftJoin('colors','colors.id','=','product_attributes.color_id')
            ->where(['product_attributes.product_id'=>$list1->id])
            ->get();
            $result['image_collection'][$list1->id]=
            DB::table('product_images')
         
            ->where(['product_images.product_id'=>$list1->id])
            ->get();
    



        }          
        

    }
   
    $result['home_featured_product']=
    DB::table('products')
    ->where(['status'=>'1'])
    ->where(['is_featured'=>'1'])
    ->get();
       
           foreach($result['home_featured_product']as $list1){
               $result['home_product_featured_attribute'][$list1->id]=
               DB::table('product_attributes')
               ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
               ->leftJoin('colors','colors.id','=','product_attributes.color_id')
               ->where(['product_attributes.product_id'=>$list1->id])
               ->get();
              
           }          
           
   
       


    
           return view('front_end.index',$result);
     }
      public function view_product ($id){
   //this code should invalid. 
        $products=DB::table('products')->where(['id'=>$id])->get();

        $result['product']=
        DB::table('products')
        ->leftJoin("categories","categories.id","=","products.category_id")
        ->leftJoin("brands","brands.id","=","products.brand_id")
        ->select(
            "products.name",
            "products.id",
            "products.category_id",
            "products.status","products.image",
            "products.is_tranding",
            "products.desc",
            "products.lead_time",
            "products.warranty",
            "products.is_discounted",
            "products.discount_amount",
            "products.is_featured","products.is_discounted",
            "categories.category_name",
            "brands.brands as brand_name"
            )
        ->where(['products.status'=>1])
        ->where(['products.id'=>$id])
        ->get();

    foreach($result['product'] as $list1){
        $result['product_attributes'][$list1->id]=
            DB::table('product_attributes')
            ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
            ->leftJoin('colors','colors.id','=','product_attributes.color_id')
       
 
            ->where(['product_attributes.product_id'=>$list1->id])
            ->get();
    }   

        $result['product_images']=
            DB::table('products')
            ->leftJoin('product_images','product_id','=','products.id')
          ->select('product_images.images as product_image_collection')
            ->where(['products.id'=>$id])
            ->get();
       
     /* echo"<pre>";
       print_r($result);
       echo"</pre>";
       die('');*/
       $review=DB::table("product_review")->
     
       select('user_name','user_email','product_id','review','rating','product_review.created_at')->

       where(["product_review.product_id"=>$id])->get();
 
       if(session()->has("FRONT_USER_ID")){
        $user_id=session('FRONT_USER_ID');
      $order_product=DB::table('order_details')->select('product_id')->where('user_id','=',$user_id)->get();
      $order_product=json_decode($order_product,true);
      foreach($order_product as $order_products){
        array_push($order_product,$order_products['product_id']);
      }
      
     $result["order_product"] = $order_product;
    }else{
     $id=$_COOKIE["CUSTOMER_ID"];
     $order_product=DB::table('order_details')->select('product_id')->where('user_id','=',$user_id)->get();
     $order_product=json_decode($order_product,true);
     
     foreach($order_product as $order_products){
  array_push($order_product,$order_products->product_id);
}

    $result["order_product"] = $order_product;
    }



    $result["user_review"]=$review;
    $result["average_rating"]=number_format(DB::table("product_review")->where('product_id','=',$id)->avg('rating'),2);
   /* prx($result);      
    die();
*/
       return view('front_end.product-detail',$result);
      }
      function cart_total_user(){
        $total=cartTotal();
        return $total;
      }
     function add_to_cart(Request $req){
 
    
  
 $size_id=$_POST["size_id"];
$color_id=$_POST["color_id"];
$product_id=$_POST["product_id"];
 $ip=ip_address();
$qty=$_POST["pqty"];
  
    

$attr_data=DB::table("product_attributes")
->select('product_attributes.id','product_attributes.qty')
->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
->leftJoin('colors','colors.id','=','product_attributes.color_id')
->where(["colors.color_name"=>$color_id])->
where(['sizes.size_name'=>$size_id])->where(["product_id"=>$product_id])->get();   
   
if(isset($attr_data[0])){
    $attr_id=$attr_data[0]->id;
 $ip=ip_address();
 $attr_qty=$attr_data[0]->qty;
 if($qty>$attr_qty){
    return response()->json(["status"=>"error", "msg"=>"This Qty is Not Available"]);
 }
 if(session()->has('FRONT_USER_ID')){
    $user_type="Reg";
  $user_id=session('FRONT_USER_ID');
     }else{
            $user_type="Non-Reg";   
            $user_id=0;
        }
    $cart_data_query=DB::table("carts")->
    where(["product_id"=>$product_id])
    ->where(['ip_add'=>$ip])->where(['attr_id'=>$attr_id])->where(["user_type"=>$user_type])->get();




    $cart_data['user_id']=$user_id;
        $cart_data['user_type']=$user_type;
        $cart_data['ip_add']=$ip;
        $cart_data["qty"]=$qty;
        $cart_data["product_id"]=$product_id;
        $cart_data["attr_id"]=$attr_id;
      if(isset($cart_data_query[0])){
        $cart=cartTotal();    
        extract($cart);
      /*  prx($cart);
      
        die();*/
       $cart_id=$cart_data_query[0]->id;
         if($qty==0){
             DB::table("carts")->where(["id"=>$cart_id])->delete();
             return response()->json([
                 "status"=>"success",
             "msg"=>"You Have Deleted Product From Cart",
             "cart_total"=>$cart_total,
             "gst"=>$gst,
             "delivery_charge"=>$delivery_charge,
             "final_price"=>$final_price,
             "total_item"=>$total_item
             
             ]);
         }

       DB::table("carts")->where(["id"=>$cart_id])->update($cart_data);
       $msg="updated";
      }else{
        DB::table("carts")->insertGetId($cart_data);
        $msg="inserted";
      }
      $cart=cartTotal();    
      extract($cart);
   return response()->json(["status"=>"success",
   "msg"=>"You Have $msg Product In Cart",
   "cart_total"=>$cart_total,
   "gst"=>$gst,
   "delivery_charge"=>$delivery_charge,
   "final_price"=>$final_price,
   "total_item"=>$total_item
   
   ]);

}
else{
    return response()->json(["status"=>"error", "msg"=>"No Product"]);
}
 
     }
         public function store(Request $request){
         $validator=  Validator::make($request->all(),[
    
             
             
              
        ],[
      
       
        ]); 
         $link=$request->headers->get('referer');
         if ($validator->fails()) {
             return redirect($link)->withErrors($validator)->withInput();
            }else{

            }
  

        
        }
        public function delete(Request $request, $id){
            /* Check If The Record Of This Id Is present */
       
        }
         public function view_product_by_cat( Request $req,$category_id)
        {
            $sort="";
            $color_sort="";
            $sort_txt="";
            $start_price="";
            $end_price="";
           if($req->get('sort')!=null){
            $sort=$req->get('sort');
           }if($req->get('color_id')!=null){
               $color_sort=$req->get('color_id');
           }
 $color_sort;
 if($req->get('filter_price_start')!=null && $req->get('filter_price_end')!=null){
   $start_price=$req->get('filter_price_start');
   $end_price=$req->get('filter_price_end');
 }
      $query=DB::table('products');
      $query=$query->leftJoin("categories","categories.id","=","products.category_id");
      $query=$query->leftJoin("brands","brands.id","=","products.brand_id");
      $query=$query->leftJoin("product_attributes","product_attributes.product_id","=","products.id");
      $query=$query->leftJoin("colors","colors.id","=","product_attributes.color_id");

    if($start_price!="" && $end_price!=""){
        $query=$query->whereBetween('product_attributes.price',[$start_price,$end_price]);
    }

        if($sort==="name" && $sort!=""){
            $query=$query->orderBy("products.name","desc");
            $sort_txt="Product Name";
        }
        if($sort=="date" && $sort!=""){
            $query=$query->orderBy("products.created_at","desc");
            $sort_txt="Date";
        }
        if($sort=='price_desc'){
            $query=$query->orderBy('product_attributes.price','desc');
            $sort_txt="Price - DESC";
        }if($sort=='price_asc'){
            $query=$query->orderBy('product_attributes.price','asc');
            $sort_txt="Price - ASC";
        }if($color_sort!=""){
$query=$query->where('colors.color_name','=',$color_sort);
        }
  
if($color_sort!=""){
$query=$query->where('colors.color_name','=',$color_sort);
        }
    
        $query=$query->where('products.status','=','1');
        $query=$query->where(['products.category_id'=>$category_id]);  

        $query=$query->distinct()->select("products.*",
  
        "categories.category_name",
        "brands.brands",
        "products.discount_amount",
        "products.created_at"
        
   );
 
      
    $query=$query->get();
    $result['category_product']=$query;
    foreach ($result["category_product"] as $key => $value) {
                 # code...
                 $result['category_product_attributes'][$value->id]=DB::table('product_attributes')
                 ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
                 ->leftJoin('colors','colors.id','=','product_attributes.color_id')
               
                 ->select(
                     'sizes.size_name',
                     'sizes.id as size_id',
                 'colors.color_name',
                 'colors.id as color_id',
      
                 "product_attributes.price",
                 "product_attributes.mrp",
                 "product_attributes.qty",
                 "product_attributes.price_after_tax",
                 )
                 ->where('product_id','=',$value->id)->
            get();
               
             }
  
$product_attributes=DB::table('product_attributes')->get();
$result['product_attributes']=$product_attributes;
     foreach ($product_attributes as $key => $value) {
       $color_id=$value->color_id;
          $result['colors'][$value->id]=DB::table('colors')->select('colors.id','colors.color_name')->where(['id'=>$color_id])->get();
     }
       $categories= DB::table("categories")->where(['parent_category_id'=>'0'])->where(['status'=>1])->get();
       

       $sizes= DB::table("sizes")->where(['status'=>1])->get();
    $req->get('filter_product');
       $result['categories']=$categories;
$result["cat_id"]=$category_id;
$result["sort_txt"]=$sort_txt;
$result["sort"]=$sort;
$result["color_sort"]=$color_sort;
$result["start_price"]=$start_price;
$result["end_price"]=$end_price;

  
return view('front_end.product',$result);
    }




    public function view_product_by_sub($category_id)
    {

    $result['category_product']=DB::table('products')
     ->leftJoin("categories","categories.id","=","products.category_id")
     ->leftJoin("brands","brands.id","=","products.brand_id")
     ->select("products.id",
     "products.name",
     "products.image",
     "products.status",
     "products.featured",
     "products.trending",
     "products.discounted",
     "products.lead_time",
     "products.category_id",
     "products.availability",
     "categories.category_name",
     "brands.brands"
     
     )

    ->where('products.status','=','1')->where(['products.sub_category_id'=>$category_id])->get();
         foreach ($result["category_product"] as $key => $value) {
             # code...
             $result['category_product_attributes'][$value->id]=DB::table('product_attributes')
             ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
             ->leftJoin('colors','colors.id','=','product_attributes.color_id')
       
             ->select(
                 'sizes.size_name',
                 'sizes.id as size_id',
             'colors.color_name',
             'colors.id as color_id',
             "taxes.tax_value",
             "product_attributes.price",
             "product_attributes.mrp",
             "product_attributes.qty",
             "product_attributes.price_after_tax",
             )
             ->where('product_id','=',$value->id)->
        get();
           
         }

$product_attributes=DB::table('product_attributes')->get();
$result['product_attributes']=$product_attributes;
 foreach ($product_attributes as $key => $value) {
   $color_id=$value->color_id;
      $result['colors'][$value->id]=DB::table('colors')->select('colors.id','colors.color_name')->where(['id'=>$color_id])->get();
 }
   $categories= DB::table("categories")->where('parent_category_id','!=','0')->where(['status'=>1])->get();
   

   $sizes= DB::table("sizes")->where(['status'=>1])->get();

   $result['categories']=$categories;

 
return view('front_end.product-sub_category',$result);
}


 function registration_process(Request $reg)
{
$user_name=$reg->post('user_name');
$user_email=$reg->post('user_email');
$user_mobile=$reg->post('user_mobile');
$user_password=$reg->post('user_password');
$user_password=Hash::make($user_password);
$user_status=1;      

$mr=mt_rand(1000,9999);
$mrt=mt_rand(1,9999999);
$mrt=bin2hex($mrt);
$mrt=md5($mrt);
$data_result=DB::table("customers")->where(["customer_email"=>$user_email])->count();
if($data_result>0){
    return response()->json(['status'=>"error",'msg'=>"User Already Exists"]);    
}else{

         
    $data["names"]=DB::table("products")->get();
    $data["token"]=$mrt;

    $users["to"]="syedabdultechnicalcop@gmail.com";
    $data["name"]=$user_name;
    $template_name="mail";
     Mail::send($template_name,$data,function($messages) use ($users){
        $messages->to($users["to"]);
        $messages->subject("Thank for Registration");
    });
$mr="";
     $insert_user_arr=[
         "customer_name"=>$user_name,
         "customer_email"=>$user_email,
         "customer_mobile"=>$user_mobile,
         "customer_password"=>$user_password,
         "customer_otp"=>$mr,
         "customer_verified"=>"0",
         "customer_rand_str"=>$mrt,
         "customer_status"=>"1"
     ];
/*print_r($insert_user_arr);*/
DB::table("customers")->insert($insert_user_arr);





  return response()->json(['status'=>"success",'msg'=>"User Register"]);  
      
    }   






    

}

public function login_process(Request $reg)
{




   $user_email=$reg->post('user_login_email');
   $user_password=$reg->post('user_login_password');
   $rem=$reg->post('rem');


   $data_result=DB::table("customers")->where(["customer_email"=>$user_email])->get();
  if(isset($data_result[0])){

           
            if($data_result[0]->customer_verified==1){
                if($data_result[0]->customer_status==1){
                    if(Hash::check($user_password,$data_result[0]->customer_password)){
                        if(isset($rem) && $rem!=null){
                           setcookie('login_email',$user_email,time()+60*60*2);
                           setcookie('login_password',$user_password,time()+60*60*2);
                        }else{
                             if(isset($_COOKIE['login_email'])){
                                setcookie('login_email',$user_email,time()-60*60*2);
                             }
                             if(isset($_COOKIE['login_password'])){
                                setcookie('login_password',$user_password,time()-60*60*2);
                             }
                        }     
                        $reg->session()->put('FRONT_USER_LOGIN','1');   
                        $reg->session()->put('FRONT_USER_ID',$data_result[0]->id); 
                        $reg->session()->put('FRONT_USER_NAME',$data_result[0]->customer_name); 
                        setcookie('CUSTOMER_ID',$data_result[0]->id,time()+60*60*24*7*2);  
                       $ip=ip_address();
                       $user_type_old="Non-Reg";
                       $user_id_old=0;
                      
                     $cart_data=DB::table("carts")->where(["ip_add"=>$ip])->get(); 
                        if(isset($cart_data[0])){
                            $user_id=$data_result[0]->id;
                            $user_type="Reg";
                                       
                    $cart_data=DB::table("carts")->where(["ip_add"=>$ip])->where(["user_id"=>$user_id_old])->where(["user_type"=>$user_type_old])->update(
                         [
                             "user_type"=>$user_type,
                             "user_id"=>$user_id
                         ]
                     );
         
                     



                        }
                return response()->json(['status'=>"success",'msg'=>"User Login ","link"=>""]); 
                 }else{
                return response()->json(['status'=>"error",'msg'=>"Wrong Password","link"=>""]); 
                }
             }else{
                return response()->json(['status'=>"error",'msg'=>"Your Account Has Been Deactivated","link"=>""]); 
             }
                }else{
                    return response()->json(['status'=>"error",'msg'=>"First Verify Your account To login","link"=>""]);   
                }
             


 

   

  }else{
    return response()->json(['status'=>"error",'msg'=>"User Not Found","link"=>""]);    
  }



}

public function invite_user(){
    echo "h";
$data["names"]=DB::table("products")->get();


    $users["to"]="syedabdultechnicalcop@gmail.com";
    $data["name"]="syedabdultechnicalcop@gmail.com";
    $template_name="mail";
     Mail::send($template_name,$data,function($messages) use ($users){
        $messages->to($users["to"]);
        $messages->subject("Thank for Registration");
    });
}
public function customer_verify($token=null){
    $rop=DB::table("customers")->where(["customer_rand_str"=>$token])->get();
    /*prx($rop);*/
    if(isset($rop[0])){
        $mrt="";
    $rop=DB::table("customers")->where(["customer_rand_str"=>$token])->update([
        "customer_verified"=>"1",
        "customer_rand_str"=>$mrt
    ]);
    return redirect('/success');
    }else{
        return redirect('/failure');
    }        
  
 
}

public function forget_password(Request $reg){

 $user_email=$_POST["user_email"];
   
 $data_result=DB::table("customers")->where(["customer_email"=>$user_email])->get();
 print_r($data_result);
 $mrt=mt_rand(1,9999999);
 $mrt=bin2hex($mrt);
 $mrt=md5($mrt);
$mr=mt_rand(1000,9999);
$data_result=DB::table("customers")->where(["customer_email"=>$user_email])->update([
    "customer_otp"=>$mr,
    "customer_rand_str"=>$mrt
]
   
);
$data_result=DB::table("customers")->where(["customer_email"=>$user_email])->get();
$token=$data_result[0]->customer_rand_str;

$user_na=$data_result[0]->customer_name;
$otp=$data_result[0]->customer_otp;
$users["to"]="syedabdultechnicalcop@gmail.com";
$users["to"]="syedabdultechnicalcop@gmail.com";
$data["name"]=$user_na;
$data["token"]=$token;
$data["otp"]=$otp;
 Mail::send("forget_mail",$data,function($messages) use ($users){
   $messages->from("syedabdultechnicalcop@gmail.com"); 
    $messages->to($users["to"]);
    $messages->subject("Link For Reset Password");
});








}
public function reset_new_password(Request $req){
     "d";
      $toke=$_POST["c_token"];
     $c_otp=$_POST["otp"];
     $new_pass=$_POST["new_pass"];

    $user_data=DB::table("customers")->where(['customer_rand_str'=>$toke])->get();

    $otp_data=$user_data[0]->customer_otp;
    $customer_id=$user_data[0]->id;
       if($c_otp===$otp_data){
           $customer_password=$user_data[0]->customer_password;
           if(Hash::check($new_pass,$customer_password)){
            return response()->json(["status"=>"error","msg"=>"Please Enter A New Password It is already in data Base"]);
           }else{
            $new_pass=Hash::make($new_pass);
            $new_rand_str="";
            $new_otp="";
            $user_data=DB::table("customers")->where(['id'=>$customer_id])->update([
              "customer_rand_str"=>$new_rand_str,
              "customer_otp"=>$new_otp
            ]);
            return response()->json(["status"=>"success","msg"=>"Password Change Successfully"]);
           }
       }else{
           return response()->json(["status"=>"error","msg"=>"You Enter Wrong OTP"]);
       }
    
}
public function reset_p($token=null){
    return view('front_end.reset_password',["token"=>$token]);
}
public function cart_view()
{
    


    $ip=ip_address();
$cart_data=userCart();
$result["cart_datas"]=$cart_data;
$cart=cartTotal();
$total_item=$cart["total_item"];
$result["total_item"]=$cart["total_item"];   
$result['cart_total']=$cart["cart_total"];
$result["delivery_charge"]=$cart["delivery_charge"];
if($total_item>0){
  
    return view('front_end.cart',$result);  
}else{
    return redirect('/');
}



 

}
public function checkout()
{


 
    $cart_data=userCart();
    $cart_data=json_decode($cart_data,true);
    $result["cart_datas"]=$cart_data;
    $cart=cartTotal();
    $total_item=$cart["total_item"];
    $result["total_item"]=$cart["total_item"];   
    $result['cart_total']=$cart["cart_total"];
    $result['gst']=$cart["gst"];
    $result['tax']=$cart["tax_value"];
    $result['delivery_charge']=$cart["delivery_charge"];
    $result['final_price']=$cart["final_price"];
    $result['discount']=$cart["discount"];
    $result['cart_after']=$cart["cart_promo"];
    $result['COUPONCODE']=$cart["COUPONCODE"];
    $result['COUPONID']=$cart["coupon_id"];
    $result["USER_ID"]=session('FRONT_USER_ID');


if(session()->has("FRONT_USER_ID")){
    $user_id=session('FRONT_USER_ID');
    $customer=DB::table("customers")->where(['id'=>$user_id])->get();
  if(isset($customer[0])){
    $result["customer_email"]=$customer[0]->customer_email;
    $result["customer_name"]=$customer[0]->customer_name;
    $result["customer_mobile"]=$customer[0]->customer_mobile;
    $result["user_id"]=$user_id;
  }else{
    $result["customer_name"]="";
    $result["customer_mobile"]="";
    $result["customer_email"]="";
    $result["user_id"]=0;

  }
  $amount=500;
  $msg="Thanks";
  $type_trans="out";
  $date_today=date("Y-m-d H:is");
 /* ManageWallet($user_id,$amount,$msg,$type_trans);*/

 $result["wallet_amt"]=WalletAmt($user_id);
 $web=webSetting();

if($total_item>0){
    return view("front_end.checkout",$result);
}else{
    return redirect('/');
}
}else{
    return view("front_end.account");
}

     



}
function cart_detail(){
$cart_data= userCart();
    $cart_data=json_decode($cart_data,true);
    $cart=cartTotal();
    $total_item=$cart["total_item"];   
    $cart_total=$cart["cart_total"];
 if($total_item==0){
        $cart_total=0;
        return response()->json(["state"=>"success","data"=>"No Item In cart","total_item"=>$total_item,"cart_total"=>$cart_total]);  
    }else{
  
        return response()->json(["state"=>"success","data"=>$cart_data,"total_item"=>$total_item,"cart_total"=>$cart_total]);  
    }

  
}
public function PlaceOrder(Request $req)
{

 $date_today=date("Y-m-d H:i:s");
 /*  $webset=webSetting();
$webset=json_decode($webset,true);
print_r($webset);*/
/*return response()->json(["status"=>"success","msg"=>"Order Placed"]);*/

extract($_POST);

$resul=DB::table("web_setting")->get();
if(isset($resul[0])){
$min_cart_amt=$resul[0]->min_cart_amt;

$web_status=$resul[0]->web_status;

}else{
    $min_cart_amt=0;   
 
    $web_status=1;


}
if($web_status!=1){
return response()->json(["status"=>"error","msg"=>"Website Is Closed"]);
}
if($total_price<$min_cart_amt){
  return response()->json(["status"=>"error","msg"=>"$total_price Rs is Less To Place Order Min Cart Amount is $min_cart_amt Rs"]);
}
 
 


if($customer_payment=="Wallet"){


    $msg="Payment For Order";
    $type_trans="out";
    ManageWallet($customer_id,$final_price,$msg,$type_trans,$date_today);
}
$data["delivery_type"]=$delivery_type;
$data["delivery_expected_time"]=$delivery_time;
$data["customer_name"]=$customer_name;
$data["customer_payment"]=$customer_payment;
$data["customer_email"]=$customer_email;
$data["customer_id"]=$customer_id;
$data["orders_status"]=$orders_status;
$data["customer_phone"]=$customer_phone;
$data["customer_address"]=$customer_address;
$data["total_price"]=$total_price;
$data["final_price"]=$final_price;
$data["gst"]=$gst;
$data["coupon_code"]=$coupon_code;
$data["coupon_value"]=$coupon_value;
$data["delivery_charge"]=$delivery_charge;
$data["zipcode"]=$zipcode;
$data["city"]=$city;
$data["district"]=$district;
$data["created_at"]=date("Y-m-d H:i:s");
$user_carts=userCartTo();
$user_carts=json_decode($user_carts,true);



    $user_order_detail=[];


 $order_id=DB::table("orders")->insertGetId($data);
foreach($user_carts as $key=> $user_cart){

    extract($user_cart);
       if($is_discounted==1){
           $price=$price-(($discount_amount/100)*$price);
       }else{
           $price=$price;
       }
    $user_order_detail["qty"]=$qty;
    $user_order_detail["attr_id"]=$attr_id;
    $user_order_detail["order_id"]=$order_id;
    $user_order_detail["price"]=$price;
    $user_order_detail["product_id"]=$product_id;
    $user_order_detail["user_id"]=$customer_id;
    $insert_id=DB::table("order_details")->insertGetId($user_order_detail);

}

if($order_id>0 && $insert_id>0){
    if(session()->has("COUPONCODE")){
        session()->forget('COUPONCODE');
    session()->forget('COUPONVALUE');
    session()->forget('COUPONID');    
    }
  
return response()->json(["status"=>"success","msg"=>"Order Placed"]);
}
}
 public function apply_coupon($coupon)
{


    $web=webSetting();
    $min_cart_amt=$web[0]->min_cart_amt;
    $min_cart_am=$web[0]->free_delivery_cart;


    if(session()->has("COUPONCODE")){
        session()->forget('COUPONCODE');
    session()->forget('COUPONVALUE');
    session()->forget('COUPONID');    
    }
  
  $coupons=DB::table('coupons')->where(["coupon_code"=>$coupon])->get();
  $cart_total=cartTotal();
  if(session()->has('FRONT_USER_ID')){
  $user_id=session('FRONT_USER_ID');
  $amt_w=WalletAmt($user_id);
      }else{
        $amt_w=0; 
      }
  extract($cart_total);
  if(isset($coupons[0])){
  
  
   

   $type=$coupons[0]->coupon_type;
      if($cart_total > $coupons[0]->cart_min_value){
     if($type=="Fixed"){
         $coupon_discount=$coupons[0]->coupon_value;
     }
     if($type=="Percentage"){
        $coupon_discount=(($coupons[0]->coupon_value)/100)*$cart_total;

    }
    if($coupons[0]->max_discount<$coupon_discount){
        $coupon_discount=$coupons[0]->max_discount;
    }else{
        $coupon_discount=$coupon_discount;
    }

     $coupon_discount;
    session()->put('COUPONCODE',$coupons[0]->coupon_code);
    session()->put('COUPONVALUE',$coupon_discount);
    session()->put('COUPONID',$coupons[0]->id);
    $status="success";
    $msg="$coupon Applied";
    $cart_total=cartTotal();
  extract($cart_total);  
    return response()->json(["cart_promo"=>$cart_promo,"gst"=>$gst,"tax_value"=>$tax_value,
    "COUPONCODE"=>$COUPONCODE,"delivery_charge"=>$delivery_charge,"final_price"=>$final_price,
    "discount"=>$discount,"coupon_id"=>$coupon_id,"cart_total"=>$cart_total,"total_item"=>$total_item,
    "status"=>$status,"msg"=>$msg,"wallet"=>$amt_w,"min_cart"=>$min_cart_am
    ]);
   }else{
    $status="error";
    $msg="$coupon Not Applied Because Cart Total ($cart_total) is Less To Apply The Coupon $coupon";
  
    return response()->json(["cart_promo"=>$cart_promo,"gst"=>$gst,"tax_value"=>$tax_value,
    "COUPONCODE"=>$COUPONCODE,"delivery_charge"=>$delivery_charge,"final_price"=>$final_price,
    "discount"=>$discount,"coupon_id"=>$coupon_id,"cart_total"=>$cart_total,"total_item"=>$total_item,
    "status"=>$status,"msg"=>$msg,"wallet"=>$amt_w,"min_cart"=>$min_cart_am
    ]);
   }
  }else{
    $status="error";
    $msg="$coupon Not Found";
  
    return response()->json(["cart_promo"=>$cart_promo,"gst"=>$gst,"tax_value"=>$tax_value,
    "COUPONCODE"=>$COUPONCODE,"delivery_charge"=>$delivery_charge,"final_price"=>$final_price,
    "discount"=>$discount,"coupon_id"=>$coupon_id,"cart_total"=>$cart_total,"total_item"=>$total_item,
    "status"=>$status,"msg"=>$msg,"wallet"=>$amt_w,"min_cart"=>$min_cart_am
    ]);
  }
}
public function thanks()
{
   
    if(session()->has('FRONT_USER_ID')){
$user_id=session('FRONT_USER_ID');

   $order_data=DB::table("carts")->where(["user_id"=>$user_id])->delete();
$orders=DB::table('orders')->where(["orders.customer_id"=>$user_id])->
   orderBy("orders.id","desc")->limit(1)->get();
       foreach($orders as $order){
         $result["order_details"]=DB::table("order_details")->
         leftJoin("product_attributes","product_attributes.id","=","order_details.attr_id")->
         leftJoin("colors","colors.id","=","product_attributes.color_id")->
         leftJoin("sizes","sizes.id","=","product_attributes.size_id")
         ->leftJoin("products","products.id","=","order_details.product_id")
         ->leftJoin("brands","brands.id","=","products.brand_id")
         ->leftJoin("categories","categories.id","=","products.category_id")
         ->select("order_details.qty","order_details.price",
         "colors.color_name","sizes.size_name","products.name",
         "products.sub_category_id",
         "products.image",
         "brands.brands",
         "categories.category_name"
         )
         ->where(["order_details.order_id"=>$order->id])->get();

       }
       $result["orders"]=$orders;
$result["total_item"]=count($result["order_details"]);
$result["cart_total"]=$orders[0]->total_price;
if($orders[0]->customer_payment=="COD"){
    $result["amount_due"]=$orders[0]->final_price." Rs ";
}else{
    $result["amount_due"]="Amount Paid";
}
$result["final_price"]=$orders[0]->final_price;
    if($orders[0]->delivery_charge==0){
        $result["delivery_charge"]="Free Delivery";


    }else{
        $result["delivery_charge"]=$orders[0]->delivery_charge." Rs ";
    }
    if($orders[0]->customer_payment=="COD"){
        $payment_method="Cash On Delivery";
    }else{
        $payment_method=$orders[0]->customer_payment;
    }
    $result["payment_method"]=$payment_method;
     $result["cityname"]="Karachi";
     $users=["abdul.samad15@hotmail.com",$orders[0]->customer_email];






return view("front_end.your_order_detail",$result);
    }else{
        return redirect('/');
    }

}
public function view_datail($id)
{
   
 


$orders=DB::table('orders')->where(["orders.id"=>$id])->
   orderBy("orders.id","desc")->limit(1)->get();
       foreach($orders as $order){
         $result["order_details"]=DB::table("order_details")->
         leftJoin("product_attributes","product_attributes.id","=","order_details.attr_id")->
         leftJoin("colors","colors.id","=","product_attributes.color_id")->
         leftJoin("sizes","sizes.id","=","product_attributes.size_id")
         ->leftJoin("products","products.id","=","order_details.product_id")
         ->leftJoin("brands","brands.id","=","products.brand_id")
         ->leftJoin("categories","categories.id","=","products.category_id")
         ->select("order_details.qty","order_details.price",
         "colors.color_name","sizes.size_name","products.name",
         "products.sub_category_id",
         "products.image",
         "brands.brands",
         "categories.category_name"
         )
         ->where(["order_details.order_id"=>$order->id])->get();

       }
       $result["orders"]=$orders;

return view("front_end.order_detail",$result);
 

}
public function invoice (Request $req ,$id )
{

    $orders=DB::table('orders')->where(["orders.id"=>$id])->
       orderBy("orders.id","desc")->limit(1)->get();
           foreach($orders as $order){
             $result["order_details"]=DB::table("order_details")->
             leftJoin("product_attributes","product_attributes.id","=","order_details.attr_id")->
             leftJoin("colors","colors.id","=","product_attributes.color_id")->
             leftJoin("sizes","sizes.id","=","product_attributes.size_id")
             ->leftJoin("products","products.id","=","order_details.product_id")
             ->leftJoin("brands","brands.id","=","products.brand_id")
             ->leftJoin("categories","categories.id","=","products.category_id")
             ->select("order_details.qty","order_details.price",
             "colors.color_name","sizes.size_name","products.name",
             "products.sub_category_id",
             "products.image",
             "brands.brands",
             "categories.category_name"
             )
             ->where(["order_details.order_id"=>$order->id])->get();
    
           }

   $link=$req->headers->get('referer');
/*prx($result);
   die();*/
$result["orders"]=$orders;
if($orders[0]->delivery_charge==0){
    $delivery_charge="Free Delivery";
}else{
    $delivery_charge=$orders[0]->delivery_charge." Rs ";
}
if($orders[0]->customer_payment=="COD"){
    $amount_due=$orders[0]->final_price." Rs ";
}else{
$amount_due="Payment Paid";

}
if($orders[0]->city==2){
$cityName="Karachi";
}else{
    $cityName="Lahore";
}
if($orders[0]->customer_payment=="COD"){
    $payment_method="Cash On Delivery";
}else{

    $payment_method=$orders[0]->customer_payment;
}   

$payment_method=Str::camel($payment_method);
$result["cityname"]=$cityName;
$result["payment_method"]=$payment_method;
$result["cart_total"]=$orders[0]->total_price;
$result["delivery_charge"]=$delivery_charge;
$result["amount_due"]=$amount_due;
$result["final_price"]=$orders[0]->final_price;
$result["total_item"]=count($result['order_details']);
$result["delivery_time"]=$orders[0]->delivery_expected_time;
$result["delivery_type"]=$orders[0]->delivery_type;
$pdf = PDF::loadView('front_end.detail',$result)->setPaper('a2',"portrait");
  $users["to"]=$orders[0]->customer_email;
/*Mail::send("front_end.invoice",$result,function($messages) use ($users,$pdf){
    $messages->to($users["to"]);
    $messages->subject("Order Invoice");
    $messages->attachData($pdf->output(),"invoice.pdf");
});*/



  /* $pdf = PDF::loadView('front_end.detail',$result);*/

   return $pdf->download('invoice.pdf');
   

}
public function pastOrder(){
    if(session()->has("FRONT_USER_ID")){
        $id=session('FRONT_USER_ID');
    }else{
     $id=$_COOKIE["CUSTOMER_ID"];
    }

    $orders=DB::table('orders')->where(["customer_id"=>$id])->
    orderBy("orders.id","asc")->get();




$result["orders"]=$orders;
$result["max_final"]=DB::table('orders')->where(["customer_id"=>$id])->max('orders.final_price');


$result["class_ta"]="";

 

return view('front_end.pastOrder',$result);

}
 public function review_rating(Request $req)
{
    if(session()->has("FRONT_USER_ID")){
        $id=session('FRONT_USER_ID');
    }else{
     $id=$_COOKIE["CUSTOMER_ID"];
    }


    extract($_POST);
    if($rating==''){
        $rating=5;
    }
    if($review!="" && $review_name!="" && $review_email!=""){
      DB::table('product_review')->insert([
          "product_id"=>$pid,
          "review"=>$review,
          "user_email"=>$review_email,
          "user_name"=>$review_name,
          "user_id"=>$id,
          "rating"=>$rating,
          "created_at"=>date("Y-m-d H:i:s")
      ]);
    }if($rating!=""){

DB::table('product_ratings')->insert([
            "product_id"=>$pid,
            "rating"=>$rating,
            "user_id"=>$id,
            "created_at"=>date("Y-m-d H:i:s")
        ]);
    }
 return response()->json([
     "status"=>"success",
     "message"=>"Rated Successfully With Review"
 ]);
}
}
