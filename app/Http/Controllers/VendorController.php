<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class VendorController extends Controller
{
     
     public function index(){

            $result['brands']=Vendor::all();
           return view('admin.vendor',$result);
     }
      public function manage_vendor($id=''){
            if($id==''){
                /* Get The Record Of Specific id From DataBase */ 
           
              $result['vendor_name']='';
              $result['vendor_email']='';
              $result['vendor_password']='';
              $result['vendor_mobile']='';
              $result['vendor_id']='';
              $result['page_btn']='Add Vendor';
              $result['page_title']='Add Vendor';
             /* echo"<pre>";
              print_r($record);
              echo"<pre>";
              die();*/
            }else{
                   $record=Vendor::where(['id'=>$id])->get();
                $result['vendor_name']=$record[0]->vendor_name;
                $result['vendor_email']=$record[0]->vendor_email;
                $result['vendor_password']='';
                $result['vendor_mobile']=$record[0]->vendor_mobile;
                $result['vendor_id']=$record[0]->id;
                $result['page_title']='Update Vendor';
                $result['page_btn']='Update Vendor';
            }

            return view('admin.manage_vendor',$result);
      }
         public function manage_vendor_process(Request $request){
            


$vendor_id=$request->post('id');
$vendor_name=$request->post('vendor_name');
$vendor_email=$request->post('vendor_email');
$vendor_password=$request->post('vendor_password');
$vendor_mobile=$request->post('vendor_mobile');

if($vendor_id==null && $vendor_id==''){
  $password_required='required';
    $vendor_model=new Vendor();
    $vendor_password=$vendor_password;
    $vendor_status=1;
    $message="Vendor Add Successfully";
}else{
    $password_required='';  
    $vendor_model=Vendor::find($vendor_id);
    $vendor_status=$vendor_model->status;
    $vendor_password=$vendor_model->vendor_password;
    $message="Vendor Update Successfully";
}


            $validator=  Validator::make($request->all(),[
    
             'vendor_password' =>$password_required,
             'vendor_mobile' =>'required',
             'vendor_name' =>'required',
             'vendor_email' =>'required|email',
        ],[
           'vendor_email.email'=>'Please Enter Valid Email Address',
           'vendor_email.required'=>'Please Enter Email Address',
           'vendor_mobile.required'=>'Please Enter Mobile Number',
           'vendor_name.required'=>'Please Enter Vendor Name',
           'vendor_password.required'=>'Please Enter Password',
        ]); 
         $link=$request->headers->get('referer');
         if ($validator->fails()) {
             return redirect($link)->withErrors($validator)->withInput();
            }else{

                $vendor_model->status=$vendor_status;
$vendor_model->vendor_email=$vendor_email;
$vendor_model->vendor_name=$vendor_name;
$vendor_model->vendor_password=$vendor_password;
$vendor_model->vendor_mobile=$vendor_mobile;
$vendor_model->save();
session()->flash("message",$message);
                return redirect('admin/vendor');
            }
  

        
        }
        public function status($vendor_id,$status){
            $vendor_model=Vendor::find($vendor_id);
            $vendor_name=$vendor_model->vendor_name;
            if($status==1){
                $new_status="Deactive";
                $new_st="0";
            }else{
                $new_status="Active";
                $new_st="1";
            }
             $vendor_model->status=$new_st;
             $vendor_model->save();
            $message="$vendor_name $new_status Successfully";
           session()->flash("message",$message);
           return redirect('admin/vendor');
        }
        public function delete(Request $request, $id){
            /* Check If The Record Of This Id Is present */
        $record_total=Vendor::where(['id'=>$id])->count();
            if($record_total>0){
         $model=Vendor::find($id);
         $model->delete();
              $link=$request->headers->get('referer');
              session()->flash("message","Vendor Deleted");
             return redirect($link);
            }else{
                session()->flash("message","Vendor Of This Id Is Not Found");
                   $link=$request->headers->get('referer');
             return redirect($link);
            }
             
        }

}
