<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Mail;
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
            ->leftJoin('taxes','taxes.id','=','product_attributes.tax_id')
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
           
   
       
/*
prx($result);
*/
    
           return view('front_end.index',$result);
     }
      public function view_product ($id){
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
            ->leftJoin('taxes','taxes.id','=','product_attributes.tax_id')
    ->select('taxes.tax_value','colors.color_name','sizes.size_name',
    'product_attributes.price_after_tax',
    'product_attributes.price',
    'product_attributes.mrp',
    'product_attributes.attr_image',
    'product_attributes.qty',
    'product_attributes.product_id',
'product_attributes.color_id',
    'product_attributes.size_id',
    )
            ->where(['product_attributes.product_id'=>$list1->id])
            ->get();
    }   

        $result['product_images']=
            DB::table('products')
            ->leftJoin('product_images','product_id','=','products.id')
          ->select('product_images.images as product_image_collection')
            ->where(['products.id'=>$id])
            ->get();
            $result['related_product']=DB::table('products')
            ->where(['products.status'=>'1'])
            ->where('products.id','!=',$id)
          ->where('products.category_id','=',$products[0]->category_id)
            ->get();
           foreach($result['related_product'] as $product_second){
        $result['product_related_attributes'][$product_second->id]=
            DB::table('product_attributes')
            ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
            ->leftJoin('colors','colors.id','=','product_attributes.color_id')
            ->leftJoin('taxes','taxes.id','=','product_attributes.tax_id')
    ->select('taxes.tax_value','colors.color_name','sizes.size_name',
    'product_attributes.price_after_tax',
    'product_attributes.price',
    'product_attributes.mrp',
    'product_attributes.attr_image',
    'product_attributes.qty',
    'product_attributes.product_id',
'product_attributes.color_id',
    'product_attributes.size_id',
    )
            ->where(['product_attributes.product_id'=>$product_second->id])
            ->get();
        
           }
     /* echo"<pre>";
       print_r($result);
       echo"</pre>";
       die('');
       prx($result);*/
       return view('front_end.product-detail',$result);
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
         public function view_product_by_cat($category_id)
        {

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
         "products.desc",
         "categories.category_name",
         "brands.brands"
         
         )

        ->where('products.status','=','1')->where(['products.category_id'=>$category_id])->get();
             foreach ($result["category_product"] as $key => $value) {
                 # code...
                 $result['category_product_attributes'][$value->id]=DB::table('product_attributes')
                 ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
                 ->leftJoin('colors','colors.id','=','product_attributes.color_id')
                 ->leftJoin('taxes','taxes.id','=','product_attributes.tax_id')
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
       $categories= DB::table("categories")->where(['parent_category_id'=>'0'])->where(['status'=>1])->get();
       

       $sizes= DB::table("sizes")->where(['status'=>1])->get();
    
       $result['categories']=$categories;

/*  prx($result);*/
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
             ->leftJoin('taxes','taxes.id','=','product_attributes.tax_id')
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
   $data_result=DB::table("customers")->where(["customer_email"=>$user_email])->get();
  if(isset($data_result[0])){

             if(Hash::check($user_password,$data_result[0]->customer_password)){
                if($data_result[0]->customer_verified==1){
                return response()->json(['status'=>"success",'msg'=>"User Login ","link"=>""]); 
                }else{
                    return response()->json(['status'=>"error",'msg'=>"First Verify Your account To login","link"=>""]);   
                }
             }else{
                return response()->json(['status'=>"error",'msg'=>"Wrong Password","link"=>""]); 
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
 if($token!=null){
    $rop=DB::table("customers")->where(["customer_rand_str"=>$token])->update([
        "customer_verified"=>"1"
    ]);
return redirect("/my_account");                 
  
 }
}

public function forget_password(Request $reg){
print_r($_POST);
echo $user_email=$_POST["user_email"];


$mr=mt_rand(1000,9999);
$data_result=DB::table("customers")->where(["customer_email"=>$user_email])->update([
    "customer_otp"=>$mr
]
   
);
$data_result=DB::table("customers")->where(["customer_email"=>$user_email])->get();
$token=$data_result[0]->customer_rand_str;

$user_na=$data_result[0]->customer_name;
$otp=$data_result[0]->customer_otp;
$users["to"]="syedabdultechnicalcop@gmail.com";
#


$users["to"]="syedabdultechnicalcop@gmail.com";
$data["name"]=$user_na;
$data["token"]=$token;
$data["otp"]=$otp;
 Mail::send("forget_mail",$data,function($messages) use ($users){
    $messages->to($users["to"]);
    $messages->subject("Link For Reset Password");
});







}
public function reset_p($token=null){
    return view('front_end.reset_password',["token"=>$token]);
}

}
