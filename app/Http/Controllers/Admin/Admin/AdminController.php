<?php

namespace App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
 $result["orders"]=Order::paginate(5);
     

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
  echo $id;
   $status;
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
 public function manage_reward_process(Request $req)
{
  unset($_POST['_token']);

  $data=$_POST;
  unset($data['_token']);
  # code...
  DB::table("rewards")->insert($data);
  return redirect('admin/reward');
}         
}
