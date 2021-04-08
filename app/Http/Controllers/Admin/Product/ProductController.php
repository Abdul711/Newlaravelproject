<?php

namespace App\Http\Controllers\Admin\Product;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;


class ProductController extends Controller
{
    public function show()
    {
        $result['data']=Product::all();
        return view('admin/product/product',$result);
    }

    
    public function manage_product(Request $request,$id='')
    {
        if($id>0){

            $sub_name=DB::table("products")->leftJoin("categories","categories.id","=","products.sub_category_id")
             ->where("products.id","=",$id)   ->get();
           $result["sub_category_name"]=$sub_name['0']->category_name;
           



            $arr=Product::where(['id'=>$id])->get(); 
    
                 $result["sub_category_id"]=$arr['0']->sub_category_id;  
            $result['category_id']=$arr['0']->category_id;
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['slug']=$arr['0']->slug;
            $result['brand']=$arr['0']->brand_id;
            $result['model']=$arr['0']->model;
            $result['short_desc']=$arr['0']->short_desc;
            $result['desc']=$arr['0']->desc;
            $result['delivery_charge']=$arr['0']->delivery_charge;
            $result['keywords']=$arr['0']->keywords;
            $result['technical_specification']=$arr['0']->technical_specification;
            $result['uses']=$arr['0']->uses;
            $result['warranty']=$arr['0']->warranty;
            $result['lead_time']=$arr['0']->lead_time;
            $result['tax_id']=$arr['0']->tax_id;
            $result['is_promo']=$arr['0']->is_promo;
            $result['is_featured']=$arr['0']->is_featured;
            $result['is_discounted']=$arr['0']->is_discounted;
            $result['is_tranding']=$arr['0']->is_tranding;
            $result['discount_amount']=$arr['0']->discount_amount;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
            $result["pageTitle"]="Update Product";
            $result['productAttrArr']=DB::table('product_attributes')->where(['product_id'=>$id])->get();

            $productImagesArr=DB::table('product_images')->where(['product_id'=>$id])->get();
            
            if(!isset($productImagesArr[0])){
                $result['productImagesArr']['0']['id']='';
                $result['productImagesArr']['0']['images']='';
            }else{
                $result['productImagesArr']=$productImagesArr;
            }
            //$result['productImagesArr']
        }else{
            $result["discount_amount"]="";
            $result["pageTitle"]="Add Product";
            $result['category_id']='';
            $result['name']='';
            $result['slug']='';
            $result['image']='';
            $result['brand']='';
            $result['model']='';
            $result['short_desc']='';
            $result['desc']='';
            $result['keywords']='';
            $result['technical_specification']='';
            $result['uses']='';
            $result['warranty']='';
            $result['lead_time']='';
            $result['tax_id']='';
            $result['is_promo']='';
            $result['delivery_charge']="";
            $result['is_featured']='';
            $result['is_discounted']='';
            $result['is_tranding']='';
            $result['status']='';
            $result['id']=0;
            $result["sub_category_id"]=0;      
            $result["sub_category_name"]="";        
            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['products_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['attr_image']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';

            $result['productImagesArr']['0']['id']='';
            $result['productImagesArr']['0']['images']='';
            /*echo '<pre>';
            print_r( $result['productAttrArr']);
            die();*/


        }
        /*echo '<pre>';
        print_r( $result);
        die();*/
        $result['category']=DB::table('categories')->where(["parent_category_id"=>0])->where(['status'=>1])->get();

        $result['sizes']=DB::table('sizes')->where(['status'=>1])->get();

        $result['colors']=DB::table('colors')->where(['status'=>1])->get();

        $result['brands']=DB::table('brands')->where(['status'=>1])->get();

        $result['taxs']=DB::table('taxes')->where(['status'=>1])->get();
$result["sub_category"]=DB::table("categories")->where('parent_category_id','!=','0')->get();

        return view('admin/product/manage_product',$result);
    }

    public function manage_product_process(Request $request)
    {
        //return $request->post();
     /*   echo '<pre>';
    print_r($request->post());
    echo '/<pre>';
    die();
    prx($request->post());*/
        if($request->post('id')>0){
            $image_validation="mimes:jpeg,jpg,png";
        }else{
            $image_validation="required|mimes:jpeg,jpg,png";
        }
        $request->validate([
            'name'=>'required',
            'image'=>$image_validation,
         
            'attr_image.*' =>'mimes:jpg,jpeg,png',
            'images.*' =>'mimes:jpg,jpeg,png'   
        ]);

        $paidArr=$request->post('paid'); 
        $skuArr=$request->post('sku'); 
        $mrpArr=$request->post('mrp'); 
        $priceArr=$request->post('price'); 
        $qtyArr=$request->post('qty'); 
        $size_idArr=$request->post('size_id'); 
        $color_idArr=$request->post('color_id'); 
        foreach($skuArr as $key=>$val){
            $check=DB::table('product_attributes')->
            where('sku','=',$skuArr[$key])->
            where('id','!=',$paidArr[$key])->
            get();

            if(isset($check[0])){
                $request->session()->flash('sku_error',$skuArr[$key].' SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }

        if($request->post('id')>0){
            $model=Product::find($request->post('id'));
            $msg="Product updated";
        }else{
            $model=new Product();
            $msg="Product inserted";
        }

        if($request->hasfile('image')){
            if($request->post('id')>0){                
                $arrImage=DB::table('products')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/'.$arrImage[0]->image);
                }
            }
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }

        $model->category_id=$request->post('category_id');;
        $model->name=$request->post('name');
     
        $model->brand_id=$request->post('brand');
        $model->sub_category_id=$request->post('sub_category');
        $model->short_desc=$request->post('short_desc');
        $model->desc=$request->post('desc');
        $model->keywords=$request->post('keywords');
        $model->discount_amount=$request->post('discount_amount');
        $model->warranty=$request->post('warranty');
        $model->lead_time=$request->post('lead_time');
        $model->tax_id=$request->post('tax_id');
        $model->delivery_charge=$request->post('delivery_charge');
        $model->is_promo=$request->post('is_promo');
        $model->is_featured=$request->post('is_featured');
        $model->is_discounted=$request->post('is_discounted');
        $model->is_tranding=$request->post('is_tranding');
        $model->status=1;
        $model->save();
        $pid=$model->id;
        /*Product Attr Start*/ 
        foreach($skuArr as $key=>$val){
            $productAttrArr=[];
            $productAttrArr['product_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key];
            $productAttrArr['mrp']=(int)$mrpArr[$key];
            $productAttrArr['price']=(int)$priceArr[$key];
            $productAttrArr['qty']=(int)$qtyArr[$key];
            if($size_idArr[$key]==''){
                $productAttrArr['size_id']=0;
            }else{
                $productAttrArr['size_id']=$size_idArr[$key];
            }
   
            if($color_idArr[$key]==''){
                $productAttrArr['color_id']=0;
            }else{
                $productAttrArr['color_id']=$color_idArr[$key];
            }

            if($request->hasFile("attr_image.$key")){
                if($paidArr[$key]!=''){ 
                    $arrImage=DB::table("product_attributes")->where(['id'=>$paidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)){
                        Storage::delete('/public/media/'.$arrImage[0]->attr_image);
                    }
                }

                $rand=rand('111111111','999999999');
                $attr_image=$request->file("attr_image.$key");
                $ext=$attr_image->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
                $productAttrArr['attr_image']=$image_name;
            }
		
            if($paidArr[$key]!=''){
                DB::table("product_attributes")->where(['id'=>$paidArr[$key]])->update($productAttrArr);
            }else{
               DB::table("product_attributes")->insert($productAttrArr);
            }
            
        }  
        
        /*Product Attr End*/ 
        
        /*Product Images Start*/
        $piidArr=$request->post('piid'); 
        foreach($piidArr as $key=>$val){
            $productImageArr['products_id']=$pid;
            if($request->hasFile("images.$key")){

                if($piidArr[$key]!=''){ 
                    $arrImage=DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->images)){
                        Storage::delete('/public/media/'.$arrImage[0]->images);
                    }
                }

                $rand=rand('111111111','999999999');
                $images=$request->file("images.$key");
                $ext=$images->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("images.$key")->storeAs('/public/media',$image_name);
                $productImageArr['images']=$image_name;
                
                if($piidArr[$key]!=''){
                    DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($productImageArr);
                }else{
                    DB::table('product_images')->insert($productImageArr);
                }
                
            }
        }
        
        /*Product Images End*/

        $request->session()->flash('message',$msg);
        return redirect('admin/product');
        
    }

    public function delete(Request $request,$id){
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('message','Product deleted');
        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request,$paid,$pid){
        $arrImage=DB::table('product_attributes')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)){
            Storage::delete('/public/media/'.$arrImage[0]->attr_image);
        }
        DB::table('product_attributes')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function product_images_delete(Request $request,$paid,$pid){
        $arrImage=DB::table('product_images')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->images)){
            Storage::delete('/public/media/'.$arrImage[0]->images);
        }
        DB::table('product_images')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }
    
    public function status(Request $request,$status,$id){
        $model=Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product status updated');
        return redirect('admin/product');
    }
    public function cat_by_id($id){
 $id;
       $category_data=DB::table("categories")->where(["parent_category_id"=>$id])->get();
       $category_data_p=DB::table("categories")->select('category_name','id')->where(["parent_category_id"=>$id])->get();

 $total_category=count($category_data);
      if($total_category>0){
      
       $data=$category_data_p;
      }else{
        $category_data_name=DB::table("categories")->where(["id"=>$id])->get();
       $cate_n=$category_data_name[0]->category_name;
        $data="There is No Sub Category In $cate_n";
      }
    return response()->json(["total_sub"=>$total_category,"data"=>$data]);
    }
}
