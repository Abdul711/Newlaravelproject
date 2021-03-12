<?php

namespace App\Http\Controllers;

use App\Models\Front;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class Front extends Controller
{
     
     public function index(){
           
     }
      public function manage($id=''){
            if($id=''){
                /* Get The Record Of Specific id From DataBase */ 
              $record=  Front::where(['id'=>$id])->get();
             /* echo"<pre>";
              print_r($record);
              echo"<pre>";
              die();*/
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
        $record_total=Front::where(['id'=>$id])->count();
            if($record_total>0){
         $model=Front::find($id);
         $model->delete();
              $link=$request->headers->get('referer');
             return redirect($link);
            }else{
                   $link=$request->headers->get('referer');
             return redirect($link);
            }

        }

}
