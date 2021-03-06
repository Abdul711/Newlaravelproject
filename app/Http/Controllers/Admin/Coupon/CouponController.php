<?php

namespace App\Http\Controllers\Admin\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
        $data=Coupon::all();
        return view('admin.coupon.coupon',['categories'=>$data]);
    }
    public function manage($id='')
    {
   
    if($id>0){
        $arr=Coupon::where(['id'=>$id])->get(); 

        $result['coupon_name']=$arr['0']->coupon_code;
        $result['coupon_value']=$arr['0']->coupon_value;
         $result['coupon_btn']="Update Coupon Code";
         $result['coupon_title']="Update Coupon Code";
         $result['coupon_cart']=$arr['0']->cart_min_value;
        $result['coupon_id']=$arr['0']->id;
        $result['coupon_type']=$arr['0']->coupon_type;
        $result["coupon_max_discount"]=$arr['0']->max_discount;
        $result["expiry_date"]=$arr['0']->expiry_date;
        $result["limit_per_user"]=$arr['0']->limit_per_user;
    }else{
        $result['coupon_name']='';
        $result['coupon_btn']="Add Coupon Code";
        $result['coupon_title']="Add Coupon Code";
        $result['coupon_id']='';
        $result['coupon_value']="";
        $result['coupon_cart']="";
        $result['coupon_type']="";
        $result["coupon_max_discount"]="";
        $result["expiry_date"]="";
        $result["limit_per_user"]="";
    }
    
  
    return view('admin/coupon/manage_coupon',$result);

}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function view_coupon_detail($id)
    {

       $coupon_data= DB::table("coupons")->where('id','=',$id)->get();
       $coupon_code=$coupon_data[0]->coupon_code;
       $coupon_type=$coupon_data[0]->coupon_type;
       $limit_per_user=$coupon_data[0]->limit_per_user;
       if($coupon_type=="Fixed"){
           $coupon_value=$coupon_data[0]->coupon_value." Rs ";
       }else{
        $coupon_value=$coupon_data[0]->coupon_value." % ";
       }
        $result["page_title"]="Coupon Detail ($coupon_code)";
        $result["coupon_value"]=$coupon_value;

   

      $expiry_date=$coupon_data[0]->expiry_date;
      $time1=strtotime($coupon_data[0]->expiry_date);
      $time2=strtotime(date("Y-M-d h:i:s"));
     

  if($time2>$time1){
    $expired="Yes";   
  }else{
      $expired="No";
  }
  $result["coupon_code"]=$coupon_code;   
        $result["expired"]=$expired;
        $result["expiry_date"]=$expiry_date;
        $result["limit_per_user"]=$limit_per_user;
        $result["coupon_type"]=$coupon_type;
        $result["cart_min_value"]=$coupon_data[0]->cart_min_value." Rs ";
        $result["max_discount"]=$coupon_data[0]->max_discount." Rs ";
        $result["register_date"]=date("d-F-Y",strtotime($coupon_data[0]->created_at));
        return view('admin.coupon.coupon_detail',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update_status($id,$status)
    {
        if($status==1){
            $message= " Coupon Deactived ";
            $new_status="0";
        }elseif($status==0){
       
           $message= "Coupon Actived ";
           $new_status="1";
   
        }
      $total_record= Coupon::where('id',$id)->count();
      if($total_record>=1){
     $model=Coupon::find($id);
     $model->status=$new_status;
     $model->save();
     session()->flash("message",$message);
     return redirect('admin/coupon');
    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon ,$id)
    { 
       
        $model=Coupon::find($id);
         $model->delete();
         session()->flash("message","Coupon Code Deleted");
        return redirect('admin/coupon');
        //
    }
    public function manage_coupon_process(Request $request)
    {
        //   

       $id= $request->post('coupon_id');

           if($id!=null){
            $link="admin/coupon/manage_coupon/".$id;
            }
            else{
                $link="admin/coupon/manage_coupon";
            }
             
        
          
           $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
                 'coupon_code'=>'required|regex:/[A-Za-z0-9]$/|unique:coupons,coupon_code,'.$request->post('coupon_id'),
                 'coupon_code_value'=>'required|regex:/[0-9]$/',
                 'cart_min_value'=>'required|regex:/[0-9]$/',
                 'coupon_type'=>'required',
                 'cart_min_value'=>'required'
              
        ],[
      
            'coupon_code.required'=>'Coupon Code must Be filled Out ',   
             'coupon_code.regex'=>'Coupon Code Must Consist Of Alphabet Or Number',
            'coupon_code.unique'=>'Coupon Code Already Exists', 
            'coupon_code_value.required'=>'Coupon Code Value must Be filled Out ',  
            'coupon_code_value.regex'=>'Coupon Code Value Must Be digits',
            'cart_min_value.regex'=>'Cart Min Value Value Must Be digits',
            'cart_min_value.required'=>'Cart Min Value Value Must Be Filled Out',
            'coupon_type.required'=>'Coupon Code Type must Be Selected ',   
        ]);   

             if ($validator->fails()) {
             return redirect($link)->withErrors($validator)->withInput();
            }else{
           
               $coupon_code= $request->post('coupon_code');
               $coupon_code_value= $request->post('coupon_code_value');
               $cart_min_value= $request->post('cart_min_value');
               $coupon_type= $request->post('coupon_type');
               $coupon_id=$request->post('coupon_id');
               $max_discount=$request->post('coupon_max_discount');
               $expiry_date=$request->post('expiry_date');
               $limit_per_user=$request->post('limit_per_user');
               if($coupon_type==="Percentage"){
                if($coupon_code_value >= 100){
                    $coupon_code_value==55;
                }
        
               }
               if($coupon_id==null){
                $message="Coupon Code Inserted";
                 $model=new Coupon();
               }else{
                $message="Coupon Code Updated";
                   $model=Coupon::find($coupon_id);
               }
            
 
               
               $model->status="1";
               $model->coupon_code=$coupon_code;
               $model->coupon_value=$coupon_code_value;
               $model->coupon_type=$coupon_type;
               $model->cart_min_value=$cart_min_value;
               $model->max_discount=$max_discount;
               $model->expiry_date=$expiry_date;
               $model->limit_per_user=$limit_per_user;
               $model->save();
            
               $request->session()->flash("message","$message");
      
                return redirect('admin/coupon');
            }

    }
}
