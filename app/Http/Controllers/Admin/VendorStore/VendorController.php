<?php

namespace App\Http\Controllers\Admin\VendorStore;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class VendorController extends Controller
{
     
    public function index(){
     $result["vendors"]=DB::table('admins')->where('role','=','2')->get();
     $result["vendors"]=json_decode( $result["vendors"],true);
       return view("admin/VendorStore/vendor_store",$result);
    }
    public function manage_vendor($id=""){

     if($id==""){
        $result["vendor_name"]="";
        $result["vendor_email"]="";
        $result["vendor_mobile"]="";
        $result["page_title"]="Add Vendor";
        $result["vendor_id"]="";
        $result["vendor_status"]=1;
     }else{
         $data=DB::table("admins")->where('role','=',2)->where('id','=',$id)->get();
        $result["vendor_name"]=  $data[0]->user_name;
        $result["vendor_email"]= $data[0]->email;
        $result["vendor_mobile"]= $data[0]->mobile;
        $result["page_title"]="Update Vendor";
        $result["vendor_id"]=$data[0]->id;
        $result["vendor_status"]= $data[0]->status;
     }
   
    
        return view("admin/VendorStore/manage_vendor_store",$result);
    }
     public function manage_vendor_process(Request $req){
   
      $name = $req->post('vendor_name');
       $email= $req->post('vendor_email'); 
       $role=2;
       $status= $req->post('status'); 
       $mobile= $req->post('vendor_mobile');
      $id=$req->post('id');
   $password= Hash::make($req->post('vendor_password'));
   $link=$req->headers->get('referer');
       request()->root();
       request()->Fullurl();
       request()->path();
       request()->URL();

   
        if($id==""){
            $insertArr["email"]=$email;
            $insertArr["user_name"]=$name;
            $insertArr["mobile"]=$mobile;
            $insertArr["role"]=$role;
            $insertArr["status"]="1";
            $insertArr["created_at"]=date("Y-m-d H:i:s");
            $insertArr["password"]=$password;

       DB::table("admins")->insert($insertArr);
        }if($id!=""){
            $insertArr["email"]=$email;
            $insertArr["user_name"]=$name;
            $insertArr["mobile"]=$mobile;
            $insertArr["role"]=$role;
            $insertArr["status"]=$status;
            $insertArr["updated_at"]=date("Y-m-d H:i:s");
            DB::table("admins")->where('id','=',$id)->update($insertArr);
        }
         return redirect('admin/vendor');
     url()->previous();
   $currentUrl=url()->current();

     /*$ip=request()->ip();
    $ip="203.109.42.158";
     $data = \Location::get($ip);*/
     
 /* $a=["Red","Red","Red","Red"] ;
print_r(array_count_values($a));
   $data=array_count_values($a);
    $data["Red"];*/

}
function delete($id){
    DB::table("admins")->where('id','=',$id)->delete();
    return redirect('admin/vendor');
}
function status($id,$status){
    $insertArr["status"]=$status;
    DB::table("admins")->where('id','=',$id)->update($insertArr);
    return redirect('admin/vendor');
}

}
