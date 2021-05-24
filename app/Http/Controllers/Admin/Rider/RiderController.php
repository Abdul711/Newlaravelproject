<?php

namespace App\Http\Controllers\Admin\Rider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class RiderController extends Controller
{
     
    public function index(){
     $result["riders"]=DB::table('admins')->where('role','=','1')->get();
     $result["riders"]=json_decode( $result["riders"],true);
       return view("admin/rider/rider",$result);
    }
    public function manage_rider($id=""){

     if($id==""){
        $result["rider_name"]="";
        $result["rider_email"]="";
        $result["rider_mobile"]="";
        $result["page_title"]="Add Rider";
        $result["rider_id"]="";
        $result["rider_status"]=1;
     }else{
         $data=DB::table("admins")->where('role','=',1)->where('id','=',$id)->get();
        $result["rider_name"]=  $data[0]->user_name;
        $result["rider_email"]= $data[0]->email;
        $result["rider_mobile"]= $data[0]->mobile;
        $result["page_title"]="Update Rider";
        $result["rider_id"]=$data[0]->id;
        $result["rider_status"]= $data[0]->status;
     }
   
    
        return view("admin/rider/manage_rider",$result);
    }
     public function manage_rider_process(Request $req){
   
      $name = $req->post('rider_name');
       $email= $req->post('rider_email'); 
       $role=1;
       $status= $req->post('status'); 
       $mobile= $req->post('rider_mobile');
      $id=$req->post('id');
   $password= Hash::make($req->post('rider_password'));
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
         return redirect('admin/rider');
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
    return redirect('admin/rider');
}
function status($id,$status){
    $insertArr["status"]=$status;
    DB::table("admins")->where('id','=',$id)->update($insertArr);
    return redirect('admin/rider');
}

}
