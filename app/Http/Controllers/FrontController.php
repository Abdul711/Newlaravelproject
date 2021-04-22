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
     $user_id=$_COOKIE["CUSTOMER_ID"];
     $order_product=DB::table('order_details')->select('product_id')->where('user_id','=',$user_id)->get();
     $order_product=json_decode($order_product,true);
     
     foreach($order_product as $order_products){
  array_push($order_product,$order_products->product_id);
}

    $result["order_product"] = $order_product;
    }

    foreach($result['product'] as $list1){
      $result["related_product"]=DB::table('products')
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
        ->where('products.id','!=',$list1->id)
        ->where("products.category_id",'=',$list1->category_id)
        ->get();

    }
    foreach($result["related_product"] as $list2){
   $data=DB::table('product_attributes')
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
        "product_attributes.product_id",
        )
        ->where('product_attributes.product_id','=',$list2->id)->
   get();

   $result["product_related_attributes"][$list2->id]=$data; 
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

 extract($_POST);
 $ip=ip_address();
 if(session()->has('FRONT_USER_ID')){
    $user_type="Reg";
  $user_id=session('FRONT_USER_ID');
     }else{
            $user_type="Non-Reg";   
            $user_id=0;
     }
 $product_attribute=DB::table("product_attributes")->
 leftJoin("sizes","sizes.id","=","product_attributes.size_id")->
 leftJoin("colors","colors.id","=","product_attributes.color_id")->
 leftJoin("products","products.id","=","product_attributes.product_id")->
 select('product_attributes.qty as product_qty','product_attributes.product_id',#
 'product_attributes.id as attribute_id',
 'product_attributes.price','products.is_discounted','products.discount_amount')->
 where('size_name','=',$size_id)->
 where('color_name','=',$color_id)->
 where('product_id','=',$product_id)->
 get();

      if(isset($product_attribute[0])){
   $price=$product_attribute[0]->price;
   $attr_id=$product_attribute[0]->attribute_id;
   $product_id=$product_attribute[0]->product_id;
   $is_discounted=$product_attribute[0]->is_discounted;
   $product_qty=$product_attribute[0]->product_qty;
    if($product_qty<$pqty){
        return response()->json(["status","error","msg"=>"Qty For This Product Not Available"]);       
    }
   if($is_discounted=="1"){
      $discount_amount=$product_attribute[0]->discount_amount;
         if($discount_amount!="" && $discount_amount>0){
             $discount=($discount_amount/100)*$price;
         }else{
             $discount=0;
         }
      
   }else{
       $discount=0;
   }
   $price=$price-$discount;
   $price=floor($price);
  $point=floor(0.2*$price);

$user_cart["attr_id"]=$attr_id;
$user_cart["user_id"]=$user_id;
$user_cart["qty"]=$pqty;
$user_cart["point"]=$point*$pqty;
$user_cart["ip_add"]=$ip;
$user_cart["user_type"]=$user_type;
$user_cart["product_id"]=$product_id;
$user_cart_data=DB::table("carts")->where('product_id','=',$product_id)->
where('attr_id','=',$attr_id)->
where('user_id','=',$user_id)->
where('user_type','=',$user_type)->
where('ip_add','=',$ip)->
get();
$total_record=count($user_cart_data);
$cart_total=cartTotal();
extract($cart_total);
$point=total_point();
if($total_record<=0){
DB::table("carts")->insert($user_cart);
$msg="Added";
}else{
    $cart_id=$user_cart_data[0]->id;
    if($pqty==0){
        $msg="Deleted From Cart";
        DB::table("carts")->where('id','=',$cart_id)->delete();
        return response()->json(["status","success","msg"=>"Product $msg Successfully ","cart_total"=>$cart_total,
        "final_price"=>$final_price,"gst"=>$gst,"delivery_charge"=>$delivery_charge,
        "points"=>$point]);
    }
    DB::table("carts")->where('id','=',$cart_id)->update($user_cart);
    $msg="Updated";
}
$cart_total=cartTotal();
extract($cart_total);

  return response()->json(["status","success","msg"=>"Product $msg Successfully ","cart_total"=>$cart_total,
  "final_price"=>$final_price,"gst"=>$gst,"delivery_charge"=>$delivery_charge,
  "points"=>$point]);
      }else{
        return response()->json(["status","error","msg"=>"Product Not Exist With Given Attribute"]);
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




    public function view_product_by_sub(Request $req ,$category_id)
    {
$result["start_price"]="";
$result["end_price"]="";
$result["category_id"]=$category_id;
$category_data=DB::table("categories")->where('id','=',$category_id)->get();
$result["page_title"]=$category_data[0]->category_name." Page";
    $result['category_product']=DB::table('products')
     ->leftJoin("categories","categories.id","=","products.category_id")
     ->leftJoin("brands","brands.id","=","products.brand_id")

     ->select("products.id",
     "products.name",
     "products.image",
     "products.status",
     "products.is_featured",
     "products.is_tranding",
     "products.is_discounted",
     "products.lead_time",
     "products.category_id",
   "products.discount_amount",
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
         
             "product_attributes.price",
             "product_attributes.mrp",
             "product_attributes.qty",
          
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
$user_referal_code=$reg->post('user_referral_code');
$user_password=Hash::make($user_password);
$user_status=1;      
 $referal_code=Str::random(6);
 

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
   /*  Mail::send($template_name,$data,function($messages) use ($users){
        $messages->to($users["to"]);
        $messages->subject("Thank for Registration");
    });*/
$mr="";



     $insert_user_arr=[
         "customer_name"=>$user_name,
         "customer_email"=>$user_email,
         "customer_mobile"=>$user_mobile,
         "customer_password"=>$user_password,
         "customer_otp"=>$mr,
         "customer_verified"=>"0",
         "customer_rand_str"=>$mrt,
         "customer_status"=>"1",
         "customer_status"=>"1",
   "customer_referral"=>$referal_code
     ];
/*print_r($insert_user_arr);*/
$customer_id=DB::table("customers")->insertGetId($insert_user_arr);
$date_today=date("Y-m-d H:i:s");
$resul=DB::table("web_setting")->get();
if(isset($resul[0])){
    $referral_amount=$resul[0]->referral_amount;
    $sign_up_reward=$resul[0]->sign_up_reward;
    }else{
        $referral_amount=0;   
         $sign_up_reward=0;
    }
if($user_referal_code!=""){
 
    $user_referal_code_data=DB::table("customers")->where("customer_referral",'=',$user_referal_code)->get();
    if(isset($user_referal_code_data[0])){
        $refer_amount=$referral_amount;
        $user_referal_code_data=DB::table("customers")->where("id",'=',$customer_id)->update(
            [
                'customer_from_referral'=>$user_referal_code
            ]
            );
    }else{
        $refer_amount=0;
        $user_referal_code_data=DB::table("customers")->where("id",'=',$customer_id)->delete();
        return response()->json(['status'=>"error",'msg'=>"Invalid Referral Code"]);
    }
}else{
    $refer_amount=0;
}
$amount_to=$sign_up_reward+$referral_amount;
  $msg="Sign Up Reward";
        $type_trans="in";
        ManageWallet($customer_id,$amount_to,$msg,$type_trans,$date_today);


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
   $messages->from("syedabdultechnicalcop@gmail.com","Daily Shop"); 
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
    

   $total_point=total_point();
    $ip=ip_address();
$cart_data=userCart();
$result["cart_datas"]=$cart_data;
$cart=cartTotal();
$total_item=$cart["total_item"];
$result["total_item"]=$cart["total_item"];   
$result['cart_total']=$cart["cart_total"];
$result["delivery_charge"]=$cart["delivery_charge"];
$result["total_point"]=$total_point;
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
 $resul=DB::table("web_setting")->get();
 /*  $webset=webSetting();
$webset=json_decode($webset,true);
print_r($webset);*/
/*return response()->json(["status"=>"success","msg"=>"Order Placed"]);*/

extract($_POST);
$delivery_time;
if($delivery_type=="scheduled"){
   $data_count=DB::table("orders")->where('delivery_expected_time','=',$delivery_time)->count();
    if($data_count>=2){
    return response()->json(["status"=>"error","msg"=>"Slot is Booked"]);    
    }
}

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
$points=total_point();
$point_type="in";
$date_today=date("Y-m-d H:i:s");
$user_point["user_id"]=$customer_id;
$user_point["point"]=$points;
$user_point["type"]=$point_type;
$user_point["created_at"]=$date_today;
managePoint($customer_id,$point_type,$points);
/*DB::table("users_ppoint")->insertGetId($user_point);*/
if($customer_payment=="COD"){
    $payment_status=0;
}else{
    $payment_status=1;
}
$data["payment_status"]=$payment_status;
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
 public function remove_coupon()
{
   
    if(session()->has('FRONT_USER_ID')){
    $user_id=session('FRONT_USER_ID');
    $amt_w=WalletAmt($user_id);
        }else{
          $amt_w=0; 
        }
        if(session()->has("COUPONCODE")){
            session()->forget('COUPONCODE');
        session()->forget('COUPONVALUE');
        session()->forget('COUPONID');    
        }
        $cart_total=cartTotal();
    extract($cart_total);
    $status="success";
    if(session()->has("COUPONCODE")){
        $coupon_code=session("COUPONCODE");
    }else{
        $coupon_code="";
    }
    $msg="Coupon Code $coupon_code Removed";
    return response()->json(["cart_promo"=>$cart_promo,"gst"=>$gst,"tax_value"=>$tax_value,
    "COUPONCODE"=>$COUPONCODE,"delivery_charge"=>$delivery_charge,"final_price"=>$final_price,
    "discount"=>$discount,"coupon_id"=>$coupon_id,"cart_total"=>$cart_total,"total_item"=>$total_item,
    "status"=>$status,"msg"=>$msg,"wallet"=>$amt_w
    ]);
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
  extract($cart_total);
  if(session()->has('FRONT_USER_ID')){
  $user_id=session('FRONT_USER_ID');
  $amt_w=WalletAmt($user_id);
      }else{
        $amt_w=0; 
      }
 
  if(isset($coupons[0])){
  
    $expiry_date=$coupons[0]->expiry_date;
      $time1=strtotime($expiry_date);
      $time2=strtotime(date("Y-M-d h:i:s"));
      if($time2>$time1){
    $status="error";
    $msg="$coupon Expired";
    return response()->json(["cart_promo"=>$cart_promo,"gst"=>$gst,"tax_value"=>$tax_value,
    "COUPONCODE"=>$COUPONCODE,"delivery_charge"=>$delivery_charge,"final_price"=>$final_price,
    "discount"=>$discount,"coupon_id"=>$coupon_id,"cart_total"=>$cart_total,"total_item"=>$total_item,
    "status"=>$status,"msg"=>$msg,"wallet"=>$amt_w,"min_cart"=>$min_cart_am
    ]);   
      }
   $type=$coupons[0]->coupon_type;
      if($cart_total > $coupons[0]->cart_min_value){
     if($type=="Fixed"){
         $coupon_discount=$coupons[0]->coupon_value;
     }
     if($type=="Percentage"){
        $coupon_discount=floor((($coupons[0]->coupon_value)/100)*$cart_total);

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
public function rad(){
    if(session()->has('FRONT_USER_ID')){
   
   $point=user_total_point(session('FRONT_USER_ID'));
            }else{
              $point=0; 
            }
            $rewards=DB::table("rewards")->where('status','=',1)->get();
            $rewards=json_decode($rewards,true);
           $result["points"]=$point;
           $result["rewards"]=$rewards;
 
    return view("front_end.point_redeem",$result);


}
  public function redeem($id)
  {

    if(session()->has('FRONT_USER_ID')){

     $user_id=session('FRONT_USER_ID');
     $data=DB::table('rewards')->where('id','=',$id)->get();

      $point=$data[0]->point;
     $type="out";
      $amount=$data[0]->reward;
      $type_trans="in";
      $msg="Reward Redeemed";
  ManageWallet($user_id,$amount,$msg,$type_trans);
  managePoint($user_id,$type,$point);
    session()->flash("message","Reward Redeem Successfully");
  return redirect('remdemPoint');
  
  

    }
  }
  function search($item){

    $search_item=DB::table("products");
    $search_item=$search_item->where("products.status","=","1");
    $search_item=$search_item->where("keywords","like","%$item%");
    $search_item=$search_item->orwhere("name","like","%$item%");
    $search_item=$search_item->orwhere("warranty","like","%$item%");
    $search_item=$search_item->orwhere("short_desc","like","%$item%");
    $search_item=$search_item->orwhere("desc","like","%$item%");
 $search_item=$search_item->leftJoin("categories","categories.id","=","products.category_id");
 $search_item=$search_item->leftJoin("brands","brands.id","=","products.brand_id");
$search_item=$search_item->select(
    "products.name",
"products.is_discounted",
"products.image",
"products.desc",
"products.short_desc"
,"products.discount_amount"
,"products.lead_time"
,"products.id",
"brands.brands",
"categories.category_name"
);
/*php artisan serve --host=192.168.1.101*/
    $search_item=$search_item->get();
    $result["search_product"]=$search_item;
    $result["sort"]="";
    $result["sort_txt"]="";
    $result["end_price"]="";
    $result["start_price"]="";
    $result["categories"]=array();
    $result["product_attributes"]=array();
    $result["colors_product"]=array();
        foreach($result["search_product"] as $search_value){
       $data=DB::table("product_attributes")->where("product_id","=",$search_value->id)
       ->leftJoin("colors","colors.id","=","product_attributes.color_id")
       ->leftJoin("sizes","sizes.id","=","product_attributes.size_id")
       ->get();
          $result["product_attributes"][$search_value->id]=$data;


        
        }

        $data_banner=DB::table('banners')->where(['status'=>'1'])->get();
        $result['banners']=$data_banner;
       return view("front_end.search_item",$result);
      
  #

}
function readd($id){
$id;
if(session()->has('FRONT_USER_ID')){
    $user_type="Reg";
  $user_id=session('FRONT_USER_ID');
     }else{
            $user_type="Non-Reg";   
            $user_id=0;
     }
    $ip_add=ip_address();
    DB::table("carts")->where("user_id",'=',$user_id)->delete();
$data=DB::table("order_details")->where(['order_id'=>$id])->get();
        foreach($data as $d){
            $point=floor(0.2*$d->price);
             $product_id=$d->product_id;
            $qty=$d->qty;
            $point=$point*$qty;
             $attr_id=$d->attr_id;
             $user_cart["attr_id"]=$attr_id;
             $user_cart["qty"]=$qty;
             $user_cart["product_id"]=$product_id;
             $user_cart["user_id"]=$user_id;
             $user_cart["user_type"]=$user_type;
             $user_cart["point"]=$point;
             $user_cart["ip_add"]=$ip_add;
            DB::table("carts")->insert($user_cart);
        }

}
}
