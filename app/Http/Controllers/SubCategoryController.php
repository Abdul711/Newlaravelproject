<?php

namespace App\Http\Controllers;
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
    
       $data=DB::table('sub_categories')->
   join('categories','categories.id','=','sub_categories.category_id')->
   select('categories.category_name','sub_categories.status','sub_categories.sub_category_name',
   'sub_categories.id','sub_categories.created_at')->get();

$data=json_decode($data,true);



     return view('admin.sub_category',["subcategories"=>$data]); 
    }
    public function manage($id='')
    {
   
    if($id>0){
        $arr=SubCategory::where(['id'=>$id])->get(); 

        $result['sub_category_name']=$arr['0']->sub_category_name;
         $result['sub_category_btn']="Update Category";
         $result['sub_category_title']="Update Category";
        $result['sub_category_id']=$arr['0']->id;
    }else{
        $result['sub_category_name']='';
        $result['sub_category_btn']="Add Sub Category";
        $result['sub_category_title']="Add Sub Category";
        $result['sub_category_id']='';
        
    }
    $data=Category::all();
    return view('admin/manage_sub_category',$result,["c"=>$data]);
}
public function update_status($id,$status){
  
     if($status==1){
         $message= "Sub Category Deactived ";
         $new_status="0";
     }elseif($status==0){
    
        $message= "Sub Category Actived ";
        $new_status="1";

     }
   $total_record= SubCategory::where('id',$id)->count();
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
             $model=new SubCategory();
           }else{
            $message="Sub Category Updated";
               $model=SubCategory::find($sub_category_id);
           }
$status=1;
           $model->category_id=$category_id;
           $model->status=$status;
           $model->sub_category_name=$category_name;
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
   



