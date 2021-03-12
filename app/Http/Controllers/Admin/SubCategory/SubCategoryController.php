<?php


namespace App\Http\Controllers\Admin\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\SubCategory;
class SubCategoryController extends Controller
{
    //
    public function show()
    {
        //
    
       $data=DB::table('categories')->where('parent_category_id','!=','0')->get();
              
$data=json_decode($data,true);
     $result['subcategories']=$data;
        foreach ($data as $key => $value) {
            $result['parent_category'][$value['id']]=parent_category_name($value['parent_category_id']);
        }


     return view('admin.sub category.sub_category',$result); 
    }
    public function manage($id='')
    {
   
    if($id>0){
        $arr=Category::where(['id'=>$id])->get(); 

        $result['sub_category_name']=$arr['0']->category_name;
         $result['sub_category_btn']="Update Category";
         $result['sub_category_title']="Update Category";
        $result['sub_category_id']=$arr['0']->id;
    }else{
        $result['sub_category_name']='';
        $result['sub_category_btn']="Add Sub Category";
        $result['sub_category_title']="Add Sub Category";
        $result['sub_category_id']='';
        
    }
    
    $data=Category::where(['parent_category_id'=>'0'])->get();
    $result['c']=$data;
    return view('admin/sub category/manage_sub_category',$result);
}
public function update_status($id,$status){
  
     if($status==1){
         $message= "Sub Category Deactived ";
         $new_status="0";
     }elseif($status==0){
    
        $message= "Sub Category Actived ";
        $new_status="1";

     }
   $total_record=Category::where('id',$id)->count();
   if($total_record>=1){
  $model=SubCategory::find($id);
  $model->status=$new_status;
  $model->save();
  session()->flash("message",$message);
  return redirect('admin/sub_category');
   }
}
public function manage_sub_category_process(Request $request)
{
    //  
 
    
   $id= $request->post('sub_category_id');

       if($id!=null){
        $link="admin/sub_category/manage_sub_category/".$id;
        }
        else{
            $link="admin/sub_category/manage_sub_category";
        }
         
    
      
       $validator=Validator::make($request->all(),[
        /*|required|regex:/[A-Z]{2,}/i*/
             'sub_category_name'=>'required|min:3|max:24|unique:sub_categories,sub_category_name,'.$request->post('sub_category_id'),
         
         
          
    ],[
  
        'sub_category_name.required'=>'Sub Category Name must Be filled Out ',   
        'sub_category_name.min'=>'Sub Category Name Must Consist Of atleast 3 Character', 
        'sub_category_name.unique'=>'Sub Category AlReady Exists', 
        'sub_category_name.max'=>'Sub Category Name must Be less then 24 characters '
    ]);   

         if ($validator->fails()) {
         return redirect($link)->withErrors($validator);
         /*withInput()*/;
        }else{
           $category_name= $request->post('sub_category_name');
           $category_id=$request->post('category_id');
           $sub_category_id=$request->post('sub_category_id');
           if($sub_category_id==null){
            $message="Sub Category Inserted";
             $model=new Category();
           }else{
            $message="Sub Category Updated";
               $model=Category::find($sub_category_id);
           }
$status=1;
              $model->parent_category_id=$category_id;
            $model->status=$status;
           $model->category_name=$category_name;
           $model->save();
        
           $request->session()->flash("message","$message");
  
            return redirect('admin/sub_category');
        }

}


public function destroy($id)
{
    //

   $id;
  $model=SubCategory::find($id);
   $model->delete();
   session()->flash("message","Sub Category Deleted");
    return redirect('admin/sub_category');

}




}
   



