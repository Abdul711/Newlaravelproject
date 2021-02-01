<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    public function show(){
        $data=DB::table('sub_categories')->
        join('categories','categories.id','=','sub_categories.category_id')->
        select('categories.category_name','sub_categories.status','sub_categories.sub_category_name','sub_categories.id','sub_categories.created_at')->get();
     
    return  $data=json_decode($data,true);
     
    }
    public function manage($id='')
    {
   
    if($id>0){
        $arr=Product::where(['id'=>$id])->get(); 

        $result['category_name']=$arr['0']->category_name;
         $result['category_btn']="Update Category";
         $result['category_title']="Update Category";
        $result['category_id']=$arr['0']->id;
    }else{
        $result['category_name']='';
        $result['category_btn']="Add Category";
        $result['category_title']="Add Category";
        $result['category_id']='';
        
    }
    return view('admin/manage_category',$result);
   }
  
}
