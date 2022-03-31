<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {   
        $result = Category::all();
        return view('admin.category.category',['data'=>$result]);
    }

    public function manage_category(Request $request, $id='')
    {
        if($id > 0){
            $arr = Category::where(['id'=>$id])->get();
            $result['id'] = $arr['0']->id;
            $result['category_name'] = $arr['0']->category_name;
            $result['category_slug'] = $arr['0']->category_slug;
        }else{
            $result['id'] = 0;
            $result['category_name'] = '';
            $result['category_slug'] = '';
        }

        return view('admin.category.manage_category', $result);
    }

    public function manage_category_process(Request $request)
    {  
    
        if($request->post('id')>0){
            $category = Category::find($request->post('id'));
            $message = "Category Updated";
        }else{
            $category = new Category();
            $message = "Category Inserted";
        }
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'category_slug'=> 'required||unique:categories,category_slug,'.$request->post('id'),
            //checking category_slug and ignoring it corresponding if there is any request for edit
        ]);
 
        if ($validator->fails()) {

            return redirect('admin/category/manage_category')
                        ->withErrors($validator)
                        ->withInput();

        }

        $category->category_name = $request->post('category');
        $category->category_slug = $request->post('category_slug');
        $category->status=1;
        $category->save();
        $request->session()->flash('message',$message);
        return redirect('admin/category');
    }   


    public function delete(Request $request, $id){
        $data = Category::find($id);
        $data->delete();
        $request->session()->flash('message','Category Deleted');
        return redirect('admin/category');     
    }

    public function status(Request $request,$status, $id){
     
        $data = Category::find($id);
        $data->status = $status;
        $data->save();
        $request->session()->flash('message','Category Status Updated');
        return redirect('admin/category');   
    }

}
