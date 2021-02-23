<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class BannerController extends Controller
{
     
     public function index(){
        $data=Banner::all();
        $result[
'data'
        ]=$data;
        return view('admin.banner.banner',$result);
     }
      public function manage($id=null){
            if($id!=null){
                /* Get The Record Of Specific id From DataBase */ 
                $record=  Banner::where(['id'=>$id])->get();
     
             $result['banner_text']=$record[0]->text;
             $result['banner_image']=$record[0]->image;
             $result['banner_slug']=$record[0]->banner_slug;
             $result['banner_link']=$record[0]->banner_link;
             $result['banner_id']=$record[0]->id;
             $result['page_title']='Update Banner';
             $result['page_btn']='Update Banner';
            }else{
            $result['banner_text']='';
            $result['banner_image']='';
            $result['banner_slug']='';
            $result['banner_link']='';
            $result['banner_id']='';
            $result['page_title']='Add Banner';
            $result['page_btn']='Add Banner';
            }
        /*    echo"<pre>";
             print_r($result);
             echo"</pre>";
             die();*/
            return view('admin.banner.manage_banner',$result);
      }
         public function store(Request $request){
           
           
            $banner_text=$request->post('banner_text');
            $banner_slug=$request->post('banner_slug');
            $banner_link=$request->post('banner_link');
            $banner_id=$request->post('banner_id');
            if($banner_id==null && $banner_id==''){
                $banner_model= new Banner();
                $image_valid='required|mimes:png';
               }else{
                $banner_model=Banner::find($banner_id);
                $image_valid='required|mimes:gif';
               }   
         $validator=  Validator::make($request->all(),[
    
             
             'image'=>$image_valid
              
        ],[
      'image.required'=>'Image is Required'
       
        ]); 
         $link=$request->headers->get('referer');
         if ($validator->fails()) {
             return redirect($link)->withErrors($validator)->withInput();
            }else{
                if($request->hasFile('image')){
            
                    $image=$request->file('image');
                    $ext=$image->extension();
                    $image_name=rand().'.'.$ext;
                     $image->storeAs('/public/media/banner',$image_name);
                       $banner_model->text=$banner_text;
                     $banner_model->image=$image_name;
                     $banner_model->banner_slug=$banner_slug;
                     $banner_model->status=1;
                     $banner_model->banner_link=$banner_link;
                     $banner_model->save();
                      
                }   

               return redirect('admin/banner'); 
            }
  
    
        
        }
        public function delete(Request $request, $id){
            /* Check If The Record Of This Id Is present */
        $record_total=Banner::where(['id'=>$id])->count();
            if($record_total>0){
         $model=Banner::find($id);
         $model->delete();
              $link=$request->headers->get('referer');
             return redirect($link);
            }else{
                   $link=$request->headers->get('referer');
             return redirect($link);
            }

        }

}
