<?php
namespace App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
       
    }
    public function manage($id='')
    {
   
    if($id>0){
        $arr=Category::where(['id'=>$id])->get(); 
     
        $result['category_name']=$arr['0']->category_name;
        $result['category_text']=$arr['0']->category_title;
         $result['category_btn']="Update Category";
         $result['category_title']="Update Category";
        $result['category_id']=$arr['0']->id;
        $result['category_image']=$arr['0']->category_image;
        $result['show_at_home']=$arr['0']->category_show;
        $result['parent_category_id']=$arr['0']->parent_category_id;
        $result['categories']=DB::table('categories')->
       where(['status'=>1])->where('id','!=',$id)->get();
    }else{
        $result['category_text']='';
        $result['category_name']='';
        $result['category_btn']="Add Category";
        $result['category_title']="Add Category";
        $result['category_id']='';
        $result['show_at_home']='';
        $result['parent_category_id']='';
        $result['categories']=DB::table('categories')->where(['status'=>1])->get();

    }

 


    return view('admin/category/manage_category',$result);

      
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
    public function manage_category_process(Request $request)
    {
        //   

        $id=$request->post('category_id');
 if($id!=''){
            $link="admin/category/manage_category/".$id;
            $category_image_valid="mimes:jpeg,png";
          
            $category_name_valid='min:3|max:24';
        
            $model=Category::find($id);
            $status=$model->status;
            if($request->hasFile("category_image")){
                $category_image=$request->file("category_image");
                
                $image_name=time().'.'.$category_image->extension();
                $category_image->storeAs('/public/media/category',$image_name);  
                #    
            }else{
                $image_name=$model->category_image;
            }

            $message="Category Updated";



}
            else{
                $link="admin/category/manage_category";
                $category_image_valid="required|mimes:jpeg,png";
                $category_name_valid='required|min:3|max:24|unique:categories,category_name';
                $message="Category Inserted";
                $status=1;
                $model=new Category();
                if($request->hasFile("category_image")){
                     $category_image=$request->file("category_image");
                     
                     $image_name=time().'.'.$category_image->extension();
                      $category_image->storeAs('/public/media/category',$image_name);           
                     #    
                 } 
       
            }

        
          
           $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
    'category_name'=>$category_name_valid,
            'category_image'=>$category_image_valid 
             
              
        ],[
      
            'category_name.required'=>'Category Name must Be filled Out ',   
            'category_name.min'=>'Category Name Must Consist Of atleast 3 Character', 
            'category_name.unique'=>'Category AlReady Exists', 
            'category_name.max'=>'Category Name must Be less then 24 characters '
        ]);   

             if ($validator->fails()) {
             return redirect($link)->withErrors($validator);
             /*withInput()*/;
            }else{
               
               $category_name= $request->post('category_name');
               $category_id=$request->post('category_id');
               $category_text=$request->post('category_text');
               $parent_category_id=$request->post('parent_category_id');
                  
               $category_show=$request->post('at_home');
     
               if(isset($category_show)){
                   $at_home=$category_show;
               }else{
                   $at_home=0;
               }
            
                 
           
               $model->category_show=$at_home;	
           
               $model->category_title=$category_text;
               $model->status=$status;
               $model->category_name=$category_name;
               $model->category_image=$image_name;
               $model->parent_category_id=$parent_category_id;      
               $model->save();
            
               $request->session()->flash("message","$message");
      
                return redirect('admin/category');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        $data_c=DB::table('categories')->get();
        $data_c=json_decode($data_c,true);

        $result['categories']=$data_c;

            foreach ($data_c as $key => $value) {
          
                  
                 
                $result['parent_category'][$value['id']]=parent_category_name($value['parent_category_id']);
                

            }
       


        return view('admin.category.category',$result); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
   
 


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update_status($id,$status)
    {
        if($status==1){
            $message= " Category Deactived ";
            $new_status="0";
        }elseif($status==0){
       
           $message= "Category Actived ";
           $new_status="1";
   
        }
      $total_record= Category::where('id',$id)->count();
      if($total_record>=1){
     $model=Category::find($id);
     $model->status=$new_status;
     $model->save();
     session()->flash("message",$message);
     return redirect('admin/category');
      }
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        //

       $id;
      $model=Category::find($id);
       $model->delete();
       session()->flash("message","Category Deleted");
        return redirect('admin/category');

    }
}
