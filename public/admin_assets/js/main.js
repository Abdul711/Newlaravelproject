$("#category_id").change(function(){
category_id=$(this).val();

path=ADMIN_PATH+"/sub/"+category_id;

   subcate_html='';
if(category_id>0){
     $.ajax({
      url:path,
      method:"get",
      success:function(response){
     
        console.log(response);
         $.each(response.data,function(arrayKey,arrayVal){
   
          subcate_html+='<option value="'+arrayVal.id+'">'+arrayVal.category_name+'</option>';
             $("#subcat").html(subcate_html);
         });


       
      }
     });
     
}else{
  subcate_html+='<option>Select Sub Category</option>';
}

   $("#subcat").html(subcate_html);

});

