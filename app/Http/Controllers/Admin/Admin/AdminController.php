<?php

namespace App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Exports\CustomersExport;
use App\Exports\Inventory;
use App\Exports\Monthly;
use Excel;
use \PDF;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function add_admin(){
         $admin_email="admin@gmail.com";
         $admin_password="admin123";
         $admin_mobile="03323565866";
         $admin_mode=Admin::where(['email'=>$admin_email])->get();
         $admin_model=new Admin();
     $total_count=Admin::where(['email'=>$admin_email])->count();
     $adm_pas=Hash::make($admin_password);
         if($total_count==0){
            $admin_role=1;
            $admin_model->email=$admin_email;
            $admin_model->mobile=$admin_mobile;
            $admin_model->password=$adm_pas;
            $admin_model->role=$admin_role;
            $admin_model->save();

         }else{
             session()->flash('message',"Admin Already Added");
              if(session()->has('ADMIN_LOGIN')){
                session()->forget('ADMIN_LOGIN');
              }

             return redirect('admin');
            
         }


     }
    public  function manage_admin_process(Request $request){
      $link=$request->headers->get('referer');
   
      $validator=Validator::make($request->all(),[
        /*|required|regex:/[A-Z]{2,}/i*/
        'vendor_mobile'=>'required',
        'vendor_email'=>'required',
        'admin_old_password'=>'required|regex:/[A-Za-z]{3,}[0-9]{1,}$/'
       ],[
    'admin_old_password.required'=>'Password Required To Update The Admin',    
    'admin_old_password.regex'=>'In Valid Password'    
       ]);
       if ($validator->fails()) {
        return redirect($link)
                    ->withErrors($validator)
                    ->withInput();   
       }else{
    
        session('ADMIN_ROLE');
         if(session()->has('ADMIN_ID')){
      $admin_id=session('ADMIN_ID');
      $admin_model=Admin::find($admin_id);
      $db_password=$admin_model->password;
      $admin_old_password=$request->post('admin_old_password');
      $admin_mobile=$request->post('vendor_mobile');
      $admin_password=$request->post('vendor_password');
      $admin_email=$request->post('vendor_email');
      if(Hash::check($admin_old_password,$db_password)){
    
          if($admin_password!=null){    
           $pattern="/[A-Za-z]{3,}[0-9]{1,}$/";
           $subject=$admin_password;
          if(!preg_match($pattern,$subject)){
            session()->flash('error_message','Invalid Password'); 
            return redirect($link);
          }


               if(Hash::check($admin_password,$db_password)){
              session()->flash('error_message','This Password Already Exists Enter New Password To Update Account'); 
              return redirect($link);
               }

             $new_password=Hash::make($admin_password);
            
           }else{
               $new_password=$admin_model->password;
           } 
           $admin_model->email=$admin_email;
           $admin_model->mobile=$admin_mobile;
           $admin_model->password=$new_password;
           $admin_model->save();
          session()->flash('success_message','Admin Update Successfully'); 
        return redirect($link);
      }else{
        session()->flash('error_message','Wrong Password Entered That Why Admin Connot Updated'); 
        return redirect($link);
      }

  
         }

            
       }
   
    }
    public function index()
    {
        //
        if(session()->has('ADMIN_LOGIN')){
          return redirect('admin/dashboard');
       }else{
         return view('admin.login');
      /*  return redirect('admin');*/
       }
   

     
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        //
        $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
                 'password'=>'required|regex:/[A-Za-z]{3,}[0-9]{1,}$/',
             
                 'email'=>'required|email',
              
           ],[
        
           'email.required'=>'Email Address Must be Provided',
           'email.email'=>'Correct Email Address Must Be Provided',
           'password.required'=>'Password Must be Provided',
            'password.regex'=>'Password Must Atleast 3 Alphabet With atleast one number'
           ]);   
          
             if ($validator->fails()) {
              return redirect('admin')
                          ->withErrors($validator)
                          ->withInput();
          }else{
           $password= $request->post('password');
             $email= $request->post('email');
          
           $result=Admin::where(['email'=>$email])->get();

           
              if(isset($result['0']->id)){
            
                $db_password=$result['0']->password;
                if(Hash::check($password,$db_password)){
                    $request->session()->put('ADMIN_LOGIN',true);
                    $request->session()->put('ADMIN_ID',$result['0']->id);
                    $request->session()->put('ADMIN_EMAIL',$result['0']->email);
                    $request->session()->put('ADMIN_ROLE',$result['0']->role);
                    return redirect('admin/dashboard');
                }else{
                    $request->session()->flash('error','Wrong Password');
                    return redirect('admin')->withInput();
                }
              }else{

                $request->session()->flash('error','this email address doesnot exist in our system');
                  return redirect('admin')->withInput();
              }
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function manage_account()
    {

 $admin_id=session('ADMIN_ID');   
 $admin_role=session('ADMIN_ROLE');   
$admin_data=Admin::where(['id'=>$admin_id])->get();

$result['admin_email']=$admin_data[0]->email;
$result['admin_mobile']=$admin_data[0]->mobile;
$result['admin_id']=$admin_data[0]->id;
$result['admin_role']=$admin_data[0]->role;

      $result['page_title']='Admin Manage Account';
      $result['admin_data']=$admin_data;

     return view('admin.manage_admin',$result);
    }
    public function dashboard()
    {
        //
        return view('admin.dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    function update_admin($id=null){
     echo $id;
     if($id!=null){
       $admin_model=Admin::find($id);
       print_r($admin_model);
     }
    }
    
    public function orders_detail (){
 $result["orders"]=DB::table('orders')->orderBy('id','desc')->get();
     

 $result["totals"]=Order::count();

      return view('admin.order.order',$result);
    }
    public function orders_view_detail ($order_id){
  $result["page_title"]="Order Detail ($order_id)";
  $result["order_detail"]=DB::table('orders')->where('orders.id','=',$order_id)->get();
  $result["cart_details"]=DB::table('order_details')
->leftJoin("product_attributes","product_attributes.id","=","order_details.attr_id")
->leftJoin("products","products.id","=","order_details.product_id")
->leftJoin("brands","brands.id","=","products.brand_id")
->leftJoin("colors","colors.id","=","product_attributes.color_id")
->leftJoin("sizes","sizes.id","=","product_attributes.size_id")
->select("order_details.price","order_details.qty",
"products.name","products.image",
"colors.color_name"
,"sizes.size_name","brands.brands")
  ->where('order_details.order_id','=',$order_id)

  ->get();
$result["total_item"]=count($result["cart_details"]);
           return view('admin.order.manage_order',$result);
         }


public function update_order_status($id,$status)
{
  



   if($status==1){
     $new_status="Under The Process";
     $new_state=2;
   }
   if($status==2){
    $new_status="Handover To Rider";
    $new_state=3;
  }
  if($status==3){
    $new_status="Out For Delivery";
    $new_state=4;
  }
  if($status==4){
     $new_status="Delivered";
     $new_state=5;
    $order_detail=order_detail($id);
 $customer_id=$order_detail[0]->customer_id;
 $coupon_value=$order_detail[0]->coupon_value;

 if($coupon_value!=0){
  $coupon_code=$order_detail[0]->coupon_code;
  $customer_id;
DB::table("coupon_usages")->insert(["coupon_code"=>$coupon_code,"user_id"=>$customer_id]);
 }

$customer_detail=customer_detail($customer_id);
 $web=webSetting();
$per=$web[0]->point_reward_per;
$amount_to=$web[0]->return_referal_per;
$admin_limit=$web[0]->number_of_order_for_referal;
$msg="Your Referrer Placed A Complete Order";
$type_tr="in";
$points=order_point($id);
$type="in";
$point=floor(($per/100)*$points);
$customer_from_referral=$customer_detail[0]->customer_from_referral;
if($customer_from_referral!=''){
$user_id=id_from_refer($customer_from_referral);
}else{
  $user_id=0;
}
managePoint($user_id,$type,$point);
$orders=NumberOfOrder($customer_id);
$total_order=$orders["total_order"];
if($admin_limit>$total_order){
ManageWallet($user_id,$amount_to,$msg,$type_tr);
}
  }
  if($status==5){
    $new_status="Delivered";
    $new_state=5;
  }
     $msg="Order is $new_status";
    $order_model=Order::find($id);
    $order_model->orders_status=$new_state;
    $order_model->save();
    session()->flash("message",$msg);
    return redirect('admin/order');
    
}
public function order_cancel($id)
{
  $date_today=date("Y-m-d H:i:s");
  $msg="Payment For Order";
  $type_trans="out";
 $model=Order::find($id);

$payment=$model->customer_payment;
$final_price=$model->final_price;
$customer_id=$model->customer_id;
$msg="Return Of Payment Due To Cancellation";
$type_trans="in";
if($payment=="Wallet"){
 ManageWallet($customer_id,$final_price,$msg,$type_trans,$date_today);
}
$model->orders_status=6;
$model->save(); 
$message="Order is Cancelled";
session()->flash("message",$message);
return redirect('admin/order');
}
public function reward_detail()
{
$rewards=DB::table("rewards")->get();
$result["rewards"]=$rewards;
return view('admin.rewards.reward',$result);
} 
public function manage_reward(){
  $result["points"]="";
  $result["rewards"]="";
  $result["page_title"]="Add Rewards";
  $result["page_btn"]="Add Rewards";

  return view('admin.rewards.manage_rewards',$result);
}
public function reward_status($id){
  echo $id;
$reward_status=DB::table('rewards')->select('status')->where('id','=',$id)->get();
prx($reward_status);
$st=$reward_status[0]->status;

if($st==1){
  $new_state="Deactive";
  $new_status=0;
}else{
  $new_state="Active";
  $new_status=1;
}
$reward_status=DB::table('rewards')->select('status')->where('id','=',$id)->update([
  'status'=>$new_status
]);
return redirect('admin/reward');
}
 public function manage_reward_process(Request $req)
{
  unset($_POST['_token']);

  $data=$_POST;
  $data["status"]="1";
  unset($data['_token']);
  # code...
  DB::table("rewards")->insert($data);
  return redirect('admin/reward');

} 
public function customers(){
  $result["customers"]=DB::table('customers')->paginate(15);
 return view('admin/customers',$result);

}
public function customer_laravel_excel()
{
return Excel::download(new CustomersExport,'users.xls');

/*
php artisan make:export CustomersExport --model=Customer*/
}
public function inventory_laravel_excel()
{
return Excel::download(new Inventory,'inventory.xls');

/*
php artisan make:export CustomersExport --model=Customer*/
}
public function inventory(){
$detail=order_detail_by_date();
$result['order_dates']=$detail;

return view('admin.inventory',$result);
}
public function inventory_monthly(){


$moth=monthly_admin();

$result['order_months']=$moth;
return view("admin.monthly_inventory",$result);
}
function  inventory_laravel_pdf(){
  



  /* PDF2::SetTitle('Customer');
   PDF2::SetAutoPageBreak(true,10);
   PDF2::SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
   PDF2::AddPage();*/
   $content="";
   $content="<style>th
   {background-color:blue;
   color:yellow;
   text-align:center;
   }
   td{
       text-align:center;
   }

   </style>";
$customer_datas=order_detail_by_date();
   $content.='<h1>Inventory Data</h1>';
   $content.='<table>';
   $content.='<tr>';
   $content.='<th>#</th>';
   $content.='<th>Order Date</th>';
   $content.='<th>Number Of Order</th>';
   $content.='<th>Amount Earned</th>';

   $content.='<th>Total Product (Sold)</th>';
   $content.='</tr>';
   foreach($customer_datas as $key=> $customer_data){
     $key=$key+1;
    $amount_gain=amount_earned($customer_data->order_date);
    $number_of_order=order_detail_by_date_no($customer_data->order_date);
    $total_item=total_item($customer_data->order_date);
    $total_qty=total_qty($customer_data->order_date);
   $content.='<tr>';
   $content.='<td>'.$key.'</td>';
   $content.='<td>'.date("d-F-Y",strtotime($customer_data->order_date)).'</td>';
   $content.='<td>'.$number_of_order.'</td>';
   $content.='<td>'.$amount_gain.' Rs </td>';
  
   $content.='<td>'.$total_qty.'</td>';
    $content.='</tr>';
  

  }
  $total_earning=TotalAdminEarning();
  $earnings=$total_earning;
  $content.='<tr>';
  $content.='<th> Total Earning </th>';
  $content.='<td>'.$earnings.' Rs </td>';
  $content.='</tr>';
  $content.='<tr>';
  $content.='<th> Gst </th>';
  $content.='<td>'. gst($earnings).' Rs </td>';
  $content.='</tr>';
  $content.='<tr>';
  $content.='<th> Final Earning </th>';
  $content.='<td>'. final_earning($earnings).' Rs </td>';
  $content.='</tr>';
   $content.='</table>';
/*     PDF2::writeHTML($content);
     PDF2::Output('hello_world.pdf');*/
    $pdf = PDF::loadHTML($content)->setPaper('a3',"portrait");

  return $pdf->download('inven_data.pdf');
 

}
function monthly_inventory_laravel_pdf(){
  $moth=monthly_admin();
  $content="";
  $content.="<table>";
  $content.="<tr>";
  $content.="<th>S.No</th>";
  $content.="<th>Month</th>";
  $content.="<th>Number Of Day</th>";
  $content.="<th>Number Of Order</th>";
  $content.="<th>Gst</th>";
  $content.="<th>My Earning</th>";
  $content.="<th>Total Earning</th>";
  $content.="</tr>";
  $i=0;
 foreach($moth as $customer){
  $po=monthly_inve($customer);
$i=$i+1;
$number_of_day=$po["number_of_day"];
$gst=$po["gst_income"];
$total_order=$po["total_order"];
$final_earning=$po["final_earning"];
$total_earning=$final_earning+$gst;
$content.="<tr>";
$content.="<td>".$i."</td>";
$content.="<td>".date("F-Y",strtotime($customer))."</td>";
$content.="<td>".$number_of_day."</td>";
$content.="<td>".$total_order."</td>";
$content.="<td>".$gst." Rs </td>";

$content.="<td>".$final_earning." Rs </td>";
$content.="<td>".$total_earning." Rs </td>";
$content.="</tr>";
 }
 $content.="</table>";
 $pdf = PDF::loadHTML($content)->setPaper('a3',"portrait");

 return $pdf->download('inven_data.pdf');

  prx($moth);

}
function monthly_inventory_laravel_excel(){
  $moth=monthly_admin();
  foreach($moth as $customer){
  $po=monthly_inve($customer);

$number_of_day=$po["number_of_day"];
$gst=$po["gst_income"];
$total_order=$po["total_order"];
$final_earning=$po["final_earning"];
$date_with_yaer=date("F-Y",strtotime($customer));

$monthly_array["month_name"]=$date_with_yaer;
$monthly_array["number_of_days"]=$number_of_day;
$monthly_array["amount_earned"]=$final_earning;
$monthly_array["total_order"]=$total_order;
$monthly_array["gst"]=$gst;
$c=DB::table("monthly_inventories")->where("month_name","=",$date_with_yaer)->count();
if($c==0){
DB::table("monthly_inventories")->insert($monthly_array);
}else{
  DB::table("monthly_inventories")->update($monthly_array);
}
  }
  return Excel::download(new Monthly,'inventory.xls');
}
function product_review (){
     $result["data"]=DB::table("product_review")->select("product_review.created_at as added_on",
     "product_review.status","product_review.user_email","product_review.user_name","product_review.review","product_review.id",
     "product_review.user_type","products.name")->leftJoin("products","products.id","=","product_review.product_id")->get();

     return view("admin.product_review",$result);
}
function subscribers(){
  $result["data"]=DB::table("subscribers")->get();
   return view("admin/subscriber",$result);
}
function view_order_by_date($d){
  $result["order_date"]=date("d-F-Y",strtotime($d));
  $result["data"]=DB::table("orders")->select('created_at','final_price','id')->where('order_date','=',$d)->get();
  return view('admin/inventory_date_detail',$result);
}
function customers_update_status($id,$status){
  $model=Customer::find($id);
  $model->customer_status=$status;
  $model->save();
  return redirect('admin/customers');
}
}