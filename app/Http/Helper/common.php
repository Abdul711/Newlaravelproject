<?php

use Illuminate\Support\Facades\DB;

function prx($arr){
    echo "<pre>";
    print_r($arr);
	echo"</pre>";

}
 function average_rating($id)
{
  # code...
  $average_rating=number_format(DB::table("product_review")->where('product_id','=',$id)->avg('rating'),2);
  
   return $average_rating;
}
function total_rating($id)
{
  # code...
  $average_rating=DB::table("product_review")->where('product_id','=',$id)->count('rating');
  
   return $average_rating;
}
 function ip_address()
{
	$ip="::1";
	
	return $ip;
}
function parent_category_name($parent_id){
     
	if($parent_id!=0){
		$cat=DB::table("categories")->where(["id"=>$parent_id])->get();
       $cat=$cat[0]->category_name;

	  }else{
		$cat="";
	  }
	  return $cat;
}
 function CategoryName($id)
{
    
    if($id!=0){
		$cat=DB::table("categories")->where(["id"=>$id])->get();
       $cat=$cat[0]->category_name;

	  }else{
		$cat="";
	  }
	  return $cat;
}
function userCart(){
	   if(session()->has('FRONT_USER_ID')){
        $user_type="Reg";
      $user_id=session('FRONT_USER_ID');
         }else{
                $user_type="Non-Reg";   
                $user_id=0;
		 }
     $ip=ip_address();
     $cart_data=DB::table("carts")
       ->leftJoin("product_attributes","product_attributes.id","=","carts.attr_id")
       ->leftJoin("products","products.id","=","carts.product_id")
       ->leftJoin("colors","colors.id","=","product_attributes.color_id")
       ->leftJoin("sizes","sizes.id","=","product_attributes.size_id")
       ->leftJoin("categories","categories.id","=","products.category_id")
       ->leftJoin("brands","brands.id","=","products.brand_id")
       ->leftJoin("taxes","taxes.id","=","products.tax_id")

    ->select(
        "carts.qty","carts.id as cart_id","carts.attr_id as attribute_id","carts.product_id as cart_product_id","carts.point as cart_point",
    "product_attributes.price as product_price","product_attributes.mrp as product_market_price",
    "products.name","products.image as product_image","products.sub_category_id","products.is_discounted","products.discount_amount",
    "colors.color_name as product_colors", "colors.id as color_id",
    "sizes.size_name as product_sizes","sizes.id as size_id",
    "categories.category_name as product_category",
    "taxes.tax_value as tax",
    "brands.brands as product_brands"
    )->where(["ip_add"=>$ip])->where(["user_type"=>$user_type])->where(["user_id"=>$user_id])->get();

    return $cart_data;
}
function userCartTo(){
  if(session()->has('FRONT_USER_ID')){
     $user_type="Reg";
   $user_id=session('FRONT_USER_ID');
      }else{
             $user_type="Non-Reg";   
             $user_id=0;
  }
  $ip=ip_address();
  $cart_data=DB::table("carts")
    ->leftJoin("product_attributes","product_attributes.id","=","carts.attr_id")
    ->leftJoin("products","products.id","=","carts.product_id")
    ->leftJoin("colors","colors.id","=","product_attributes.color_id")
    ->leftJoin("sizes","sizes.id","=","product_attributes.size_id")
    ->leftJoin("categories","categories.id","=","products.category_id")
    ->leftJoin("brands","brands.id","=","products.brand_id")
    ->leftJoin("taxes","taxes.id","=","products.tax_id")

 ->select(
     "carts.qty",
     "carts.attr_id as attr_id","carts.product_id as product_id",
 "product_attributes.price as price","products.is_discounted","products.discount_amount"

 )->where(["ip_add"=>$ip])->where(["user_type"=>$user_type])->where(["user_id"=>$user_id])->get();

 return $cart_data;
}
function cartTotal(){
	$ip=ip_address();
    if(session()->has('FRONT_USER_ID')){
        $user_type="Reg";
      $user_id=session('FRONT_USER_ID');
         }else{
                $user_type="Non-Reg";   
                $user_id=0;
		 }
   $cat=DB::table("carts")->
	leftJoin("products","products.id","=","carts.product_id")
	->leftJoin("product_attributes","product_attributes.id","=","carts.attr_id")
    ->leftJoin("taxes","taxes.id","=","products.tax_id")
->select("product_attributes.price","carts.qty as cart_qty",
"taxes.tax_value as tax","products.delivery_charge","products.is_discounted","products.discount_amount")
->where(['ip_add'=>$ip])->where(["user_type"=>$user_type])->where(["user_id"=>$user_id])->get();
if(session()->has("FRONT_USER_ID")){
  $web=webSetting();
  $user_id=session('FRONT_USER_ID');
$min_cart_amt=$web[0]->min_cart_amt;
$min_cart_am=$web[0]->free_delivery_cart;
$order=$web[0]->no_of_order;
$total=DB::table('orders')->where(['customer_id'=>$user_id])->count();
if($total>=$order){
$promotion=0;
}else{
  $promotion=$web[0]->discount_on_first;
}


}else{
  $promotion=0;
}

$cart_total=0;
$tax_total=0;

$delivery_total=0;
$tax=0;
$total=count($cat);
foreach($cat as $cart_detail){
  if($cart_detail->is_discounted=="1"){
$price=$cart_detail->price-(($cart_detail->discount_amount/100)*$cart_detail->price);
  }else{
    $price=$cart_detail->price;
  }
   $cart_total=$cart_total+$price * $cart_detail->cart_qty;
if($cart_detail->tax!=''){
	$tax_total=$tax_total+$cart_detail->tax;
}else{
	$tax_total=0;
}
if($cart_detail->delivery_charge!=''){
	$delivery_total=$delivery_total+$cart_detail->delivery_charge;

}else{
	$tax_total=0;
    $delivery_total=0;
}
 
}

if($total>0){
    $delivery_charge=round($delivery_total);
        $tax=round($tax_total/$total);
       }else{
        $tax=0;
        $delivery_charge=0;
       }
$cart_total=$cart_total-$promotion;
$cart_array["cart_total"]=$cart_total;
$cart_array["total_item"]=count($cat);

if(session()->has("COUPONCODE")){
    $coupon_code=session('COUPONCODE');
    $coupon_value=session('COUPONVALUE');
    $coupon_id=session('COUPONID');
}else{
    $coupon_code="No Coupon";
    $coupon_value="0";
    $coupon_id="0";

}
$web=webSetting();
$min_cart_amt=$web[0]->min_cart_amt;
$free_delivery=$web[0]->free_delivery_cart;

$cp=$cart_total-$coupon_value;
if($cp>=$free_delivery){
    $delivery_charge=0;
}else{
  $delivery_charge=$delivery_charge;
}
$cart_array["cart_promo"]=$cp;
$gst=floor($tax/100*$cart_total);
$cart_array["gst"]=$gst;
$cart_array["tax_value"]=$tax;
$cart_array["COUPONCODE"]=$coupon_code;
$delivery_charge=floor($delivery_charge);
$cart_array["delivery_charge"]=$delivery_charge;
$cart_array["final_price"]=($cp+$delivery_charge+$gst);
$cart_array["discount"]=$coupon_value;
$cart_array["coupon_id"]=$coupon_id;
return $cart_array;
}
function WalletAmt($user_id){
   $amt= DB::table("wallet")->where(["user_id"=>$user_id])->where(["type_trans"=>"in"])->get();
   $in=0;
   $out=0;   
   foreach($amt as $a){
   $amount=$a->amount;
      if($a->type_trans="in"){
        $in=$in+$amount;
      }
    }
    $amt2= DB::table("wallet")->where(["user_id"=>$user_id])->where(["type_trans"=>"out"])->get();
  
    foreach($amt2 as $a){
    $amount2=$a->amount;
       if($a->type_trans="out"){
         $out=$out+$amount2;
       }
     }
  
    return $in-$out;  

}
 function ManageWallet($user_id,$amount,$msg,$type_trans)
{
  $today=date("Y-m-d H:i:s");
    DB::table("wallet")->insert([
"user_id"=>$user_id,
"amount"=>$amount,
"msg"=>$msg,
"type_trans"=>$type_trans,
"created_at"=>$today

    ]);
}
function webSetting()
{
return  DB::table("web_setting")->where('id','=','1')->get();

}
function total_point(){
 $user_carts= userCart();
 $user_carts=json_decode($user_carts,true);
 $user_cat_point=0;
 foreach($user_carts as $user_cart){
  $user_cat_point=$user_cat_point+($user_cart["cart_point"]);
 }
 return $user_cat_point;
}
function coupon_used($coupon){
return DB::table("orders")->where("coupon_code",'=',$coupon)->count();
}
function coupon_used_by_user($coupon,$user_id){
  return DB::table("orders")->where('customer_id','=',$user_id)->where("coupon_code",'=',$coupon)->count();
  }
function user_total_point($user_id){
 $user_point_data= DB::table("users_ppoint")->where(["user_id"=>$user_id])->get();
 $user_point=$user_point_data;
 $in_point=0;
 $out_point=0;
    foreach($user_point as $user_points){
      if($user_points->type=="in"){
        $in_point=$in_point+$user_points->point;
      }
      if($user_points->type=="out"){
        $out_point=$out_point+$user_points->point;
      }
    }
     $in_point;
   $out_point;
   $myPoint=$in_point-$out_point;
      if($myPoint<=0){
        $myPoint=0;
      }

 return $myPoint;
}
 function managePoint($user_id,$type,$point)
{
  
  $date_today=date("Y-m-d H:i:s");
  $user_point["point"]=$point;
$user_point["user_id"]=$user_id;
  $user_point["type"]=$type;
  $user_point["created_at"]=$date_today;
  DB::table("users_ppoint")->insert($user_point);
}
function NumberOfOrder ($id)
{
  $total_order=DB::table("orders")->where("customer_id",'=',$id)->count();
  $total_amount_expand=DB::table("orders")->where("customer_id",'=',$id)->sum('final_price');
  $total_array["total_order"]=$total_order;
  $total_array["total_amount_expand"]=$total_amount_expand;
return $total_array;
}
function order_detail($id){
  $total_order=DB::table("orders")->where("id",'=',$id)->get();
  return $total_order;
}
function customer_detail($customer_id){
  $total_order=DB::table("customers")->where("id",'=',$customer_id)->get();
  return $total_order;
}
function id_from_refer($customer_from_referral){
  $customer_detail=	DB::table('customers')->where('customer_referral','=',$customer_from_referral)->get();
 return $customer_detail[0]->id;
}
function order_point($id){
 $points=DB::table('order_details')->where('order_id','=',$id)->get();
 $total_point=0;
foreach($points as $point){
$price=$point->price;
 $point=floor(0.2*$price);
 $total_point=$total_point+$point;
}
 $total_point;
  return $total_point;
}
function order_detail_by_date(){
return DB::table('orders')->distinct()->select('order_date')->orderBy('order_date')->get();
}
function order_detail_by_date_no($date_t){
 return DB::table('orders')->where('order_date','=',$date_t)->count();

}
function order_complete($date_t){
  return DB::table('orders')->where('order_date','=',$date_t)->where('orders_status','=','5')->count();
 
 }
 function order_cancel($date_t){
  return DB::table('orders')->where('order_date','=',$date_t)->where('orders_status','=','6')->count();
 
 }
function amount_earned($date_t){
  return DB::table('orders')->where('order_date','=',$date_t)->where('orders_status','=','5')->sum('final_price');
 
 }
 function TotalAdminEarning(){
  $order_details=order_detail_by_date();
  $totalEarning=0;
  foreach ($order_details as $key => $detail) {

$amount_gain=amount_earned($detail->order_date);
$totalEarning=$totalEarning+$amount_gain;
  }
  return   $totalEarning;
 }
 function gst($total_earning){
  $web=webSetting();
  $income_tax=$web[0]->income_tax;
   return floor($income_tax/100*$total_earning);
 }
  function final_earning($final_earning){
 $gst=gst($final_earning);
 return $final_earning-$gst;
  }
 function TotalAdminEarningRecords($numbers_add){
  $order_details=order_detail_by_date();
  $totalEarning=0;
 
  return count($order_details)+$numbers_add;
 }
 function total_item($date_t){
  return DB::table('orders')->leftJoin('order_details','order_details.order_id','=','orders.id')->
  where('orders.order_date','=',$date_t)->where('orders.orders_status','=','5')->count();
 
 }
 function total_qty($date_t){
  return DB::table('orders')->leftJoin('order_details','order_details.order_id','=','orders.id')->
  where('orders.order_date','=',$date_t)->where('orders.orders_status','=','5')->sum('order_details.qty');
 }
 function referal_code($user_name){
$data=DB::table("customers")->select("customer_referral")->where("customer_name","=",$user_name)->get();
return$datad= $data[0]->customer_referral;
 }
 function Last_order_date($user_name){
  $data=DB::table("orders")->select("created_at")->where("customer_id","=",$user_name)->orderBy("id","desc")->limit(1)->get();
  return$datad= date("d-F-Y",strtotime($data[0]->created_at));
   }
   function Last_order_time($user_name){
    $data=DB::table("orders")->select("created_at")->where("customer_id","=",$user_name)->orderBy("id","desc")->limit(1)->get();
    return$datad= date("h:i a",strtotime($data[0]->created_at));
     }
?>