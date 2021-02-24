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
         $result['category_btn']="Update Category";
         $result['category_title']="Update Category";
        $result['category_id']=$arr['0']->id;
    }else{
        $result['category_name']='';
        $result['category_btn']="Add Category";
        $result['category_title']="Add Category";
        $result['category_id']='';
        
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
       $id= $request->post('category_id');

           if($id!=null){
            $link="admin/category/manage_category/".$id;
            }
            else{
                $link="admin/category/manage_category";
            }
             
        
          
           $validator=Validator::make($request->all(),[
            /*|required|regex:/[A-Z]{2,}/i*/
    'category_name'=>'required|min:3|max:24|unique:categories,category_name'
             
             
              
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
               $status=1;
               if($category_id==null){
                $message="Category Inserted";
                 $model=new Category();
               }else{
                $message="Category Updated";
                   $model=Category::find($category_id);
               }

               
               $model->status=$status;
               $model->category_name=$category_name;
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
         $data=Category::all();
        return view('admin.category.category',['categories'=>$data]); 
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
