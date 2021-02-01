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

        $result['product_name']=$arr['0']->product_name;
         $result['product_btn']="Update Product";
         $result['product_title']="Update Product";
        $result['product_id']=$arr['0']->id;
    }else{
        $result['product_name']='';
        $result['product_btn']="Add Product";
        $result['product_title']="Add Product";
        $result['product_id']='';
        
    }
    $data=Category::all();
    $data_s=SubCategory::all();
    $data_color=Color::all();
    $data_size=Size::all();
    return view('admin/manage_product',$result,['c'=>$data,'sub'=>$data_s,'sizes'=>$data_size,'colors'=>$data_color]);
   }
   public function manage_product_process(Request $request){
   $image= $request->file('image');
    $ext=$image->extension();
    $image_name = time().'.'.$ext;
    $image->storeAs('/public/media',$image_name);g
    return $request->post();
   }  
}
