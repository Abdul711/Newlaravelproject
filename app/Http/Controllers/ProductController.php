<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Color;
use  App\Models\Size;
use  App\Models\ProductAttribute;
use  App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data=Product::all();
     return view('admin.product',["data"=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function manage_product($id='')
    {
        
        if($id==''){
            $page_data['page_title']="Add Product";
            $page_data['page_btn']="Add Product";
             $product_data['product_name']='';
            $product_data['category_id']='';
            $product_data['sub_category_id']='';
            $product_data['image']='';
            $product_data['brand_id']='';
            $product_data['id']='';
            $product_attributes[0]['id']='';
            $product_attributes[0]['color_id']='';      
            $product_attributes[0]['size_id']='';
            $product_attributes[0]['qty']='';
            $product_attributes[0]['price']='';
            $product_attributes[0]['sku']='';
            $product_attributes[0]['mrp']='';
            $product_attributes[0]['attr_image']='';
        }else{
            $product_data=DB::table('products')->where(['id'=>$id])->get();
             $product_data=json_decode($product_data,true);
             $product_data=$product_data[0];
              $product_attributes=ProductAttribute::where(['product_id'=>$id])->get();
            $product_attributes=json_decode($product_attributes,true);
            $page_data['page_title']="Update Product";
            $page_data['page_btn']="Update Product";
        }
    
      $color_data=Color::where(['status'=>'1'])->get(); 
      $color_data=json_decode($color_data,true);  
      $size_data=Size::where(['status'=>'1'])->get(); 
      $size_data=json_decode($size_data,true);  
      $category_data=Category::where(['status'=>'1'])->get(); 
      $category_data=json_decode($category_data,true); 
      $sub_category_data=SubCategory::where(['status'=>'1'])->get(); 
      $sub_category_data=json_decode($sub_category_data,true); 
      $brand_data=Brand::where(['status'=>'1'])->get(); 
      
  
       return view('admin.manage_product',$page_data,[
           "product_data"=>$product_data,
           "product_attributes"=>$product_attributes,
           "colors"=>$color_data,
           "sizes"=>$size_data,
           "categories"=>$category_data,
           "subcategories"=>$sub_category_data,
           "brands"=>$brand_data
           ]);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function manage_product_process(Request $request)
    {
       $link=$request->headers->get('referer');  

    
        if($request->post('id')==''){
        $name_valid="required|min:3|max:24|unique:products,product_name";
        $image_valid="required|mimes:jpg,png";
        }else{
            $name_valid="required|min:3|max:24";
            $image_valid="mimes:jpg,png";
        }
       $name_valid;
        $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
             'name'=>$name_valid,
             'image'=>$image_valid,
             
             
              
        ],[
      
            'name.required'=>'Product Name must Be filled Out ',   
            'name.min'=>'Product Name Must Consist Of atleast 3 Character', 
            'name.unique'=>'Product AlReady Exists', 
            'name.max'=>'Product Name must Be less then 24 characters '
        ]);   
        $link=$request->headers->get('referer');
             if ($validator->fails()) {
             return redirect($link)->withErrors($validator);
             /*withInput()*/;
            }


   echo "<pre>";     
   print_r($request->post());

   echo "</pre>";  
   $previous_link=$request->headers->get('referer');
   $product_id=$request->post('id');
   $category_id=$request->post('category_id');
   $sub_category_id=$request->post('sub_category_id');
   $brand_id=$request->post('brand');
   $product_name=$request->post('name');
   $token=$request->post('_token');
   $product_attr_id_array=$request->post('paid');
   $product_attr_price_array=$request->post('price');
   $product_attr_mrp_array=$request->post('mrp');
   $product_attr_qty_array=$request->post('qty');
   $product_attr_color_array=$request->post('color_id');
   $product_attr_size_array=$request->post('size_id');
   $product_attr_sku_array=$request->post('sku');
 
   
        if($product_id==null && $product_id==''){
           $product_model=new Product();
           $new_status=1;
           $message="Product Inserted";
         if($request->hasFile('image')){
             $image=$request->file('image');
             $image_name=mt_rand()+rand().".".$image->extension();
             $image->storeAs('/public/media',$image_name);
             $product_model->image=$image_name;



         }

        }else{
            $product_model=Product::find($product_id);
          $old_image=$product_model->image;
  

            if($request->hasFile('image')){
                if(Storage::exists('/public/media/',$old_image)){
             
                 Storage::delete("/public/media/$old_image");
                }
                
                $image=$request->file('image');
                $image_name=mt_rand()+rand().".".$image->extension();
                $image->storeAs('/public/media',$image_name);
                $product_model->image=$image_name;
         
   
   
            }else{
                $product_model->image=$old_image;  
            }
                 
   
                  
            $new_status=$product_model->status;
            $message="Product Updated";
        }
   
   
    


        $product_model->product_name=$product_name;
        $product_model->category_id=$category_id;
        $product_model->sub_category_id=$sub_category_id;
        $product_model->brand_id=$brand_id;
        $product_model->status=$new_status;
        $product_model->token=$token;
        $product_model->save();
        
        $product_id=$product_model->id;

      
        foreach ($product_attr_id_array as $key => $value) {
            $attr_id=$product_attr_id_array[$key];
           $attr_price=$product_attr_price_array[$key];
               $attr_mrp=$product_attr_mrp_array[$key];
               $attr_qty=$product_attr_qty_array[$key];
               $attr_size=$product_attr_size_array[$key];
               $attr_color=$product_attr_color_array[$key];
               $attr_sku=$product_attr_sku_array[$key];
                if($attr_id=='' && $attr_id==null){
                  
                     $attribute_model=new ProductAttribute();
                    if($request->hasFile("attr_image.$key")){
                        $image_attr=$request->file("attr_image.$key");
                        $image_name=mt_rand().".".$image_attr->extension();
                        $image_attr->storeAs('/public/media/attr_image',$image_name);
                        $attribute_model->attr_image=$image_name;
                    }
                }else{
                    $attribute_model=ProductAttribute::find($attr_id);
               
        
               

                    $old_attribute_image=$attribute_model->attr_image;
                    if($request->hasFile("attr_image.$key")){
                        $old_attribute_image=$attribute_model->attr_image;
                        if(Storage::exists('/public/media/attr_image',$old_attribute_image)){
             
                            Storage::delete("/public/media/attr_image/$old_attribute_image");
                        }
                       $image_attr=$request->file("attr_image.$key");
                       $image_name=mt_rand().".".$image_attr->extension();
                       $image_attr->storeAs('/public/media/attr_image',$image_name);
                       $attribute_model->attr_image=$image_name;
                    }else{
                       $attribute_model->attr_image=$old_attribute_image;
                    }
                  
                     "attribute id  found";
                }
                $attribute_model->color_id=$attr_color;
                $attribute_model->size_id=$attr_size;
                $attribute_model->price=$attr_price;
                $attribute_model->mrp=$attr_mrp;
                $attribute_model->sku=$attr_sku;
                $attribute_model->qty=$attr_qty;
                $attribute_model->product_id=$product_id;
                $attribute_model->save();
           }     
      
      
      
      
      
      
      
      
      
      
      
        session()->flash("message",$message);
       return redirect('admin/product');
    }
    public function status(Request $request,$product_id,$status)
    {
        $product_model_status=Product::find($product_id);
       $product_name=$product_model_status->product_name;
        if($status==0){ 
            $message="Product Activated SuccessFully";
             $new_status="1";
        }else{
            $message="Product Dectivated SuccessFully";
            $new_status="0";
        }
        $product_model_status->status=$new_status;
        $product_model_status->save();
        session()->flash("message",$message);
        $link=$request->headers->get('referer');
        return redirect($link);
    }
     public function product_attr_delete($product_id,$attr_id)

     {
        $attribute_model=ProductAttribute::find($attr_id);
       $attr_image=$attribute_model->attr_image;
      if(Storage::exists('/public/media/attr_image/',$attr_image)){
             
        Storage::delete("/public/media/attr_image/$attr_image");
       }
       session()->flash("message","Attribute Deleted Successfully");
        $attribute_model->delete();
       $link="admin/product/manage_product/$product_id";
        return redirect($link);
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($product_id)
    {
        //
       $product_attr_data=DB::table('product_attributes')->where(['product_id'=>$product_id])->get();
      
       $product_data=DB::table('products')->where(['id'=>$product_id])->get();
       $product_data=json_decode($product_data,true);
       $product_attr_data=json_decode($product_attr_data,true);
              foreach ($product_data as $key => $value) {
                 $image_to_delete=$value['image'];
     if(Storage::exists('/public/media/',$image_to_delete)){
             
            Storage::delete("/public/media/$image_to_delete");


        }
              }

              foreach ($product_attr_data as $key => $value) {
                $image_to_delete=$value['attr_image'];
             if(Storage::exists('/public/media/attr_image/',$image_to_delete)){
                     
                    Storage::delete("/public/media/attr_image/$image_to_delete");
        
        
                }
              }
              DB::table('product_attributes')->where(['product_id'=>$product_id])->delete();
      
              DB::table('products')->where(['id'=>$product_id])->delete();
        $message="Product Deleted";
              session()->flash("message",$message);       
          return redirect('admin/product');
           
    }
}
