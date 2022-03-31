<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public function index()
    {   
        $result = Size::all();
        return view('admin.size.size',['data'=>$result]);
    }

    public function manage_size(Request $request, $id='')
    {
        if($id > 0){
            $arr = Size::where(['id'=>$id])->get();
            $result['id'] = $arr['0']->id;
            $result['size'] = $arr['0']->size;
            $result['status'] = $arr['0']->status;
        }else{
            $result['id'] = 0;
            $result['size'] = '';
            $result['status'] = '';
        }

        return view('admin.size.manage_size', $result);
    }

    public function manage_size_process(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'size'=> 'required||unique:sizes,size,'.$request->post('id'),
            //checking size code if it is unique and ignoring it corresponding if there is any request for edit
        ]);
 
        if ($validator->fails()) {

            return redirect('admin/size/manage_size')
                        ->withErrors($validator)
                        ->withInput();

        }
    
        if($request->post('id')>0){
            $size = Size::find($request->post('id'));
            $message = "Size Updated";
        }else{
            $size = new Size();
            $message = "Size Inserted";
        }

        $size->size = $request->post('size');
        $size->status = 1;
        $size->save();
        $request->session()->flash('message',$message);
        return redirect('admin/size');
    }   

    public function delete(Request $request, $id){
        $data = Size::find($id);
        $data->delete();
        $request->session()->flash('message','Size Deleted');
        return redirect('admin/size');     
    }

    public function status(Request $request, $status, $id){
        $data = Size::find($id);
        $data->status = $status;
        $data->save();
        $request->session()->flash('message',"Size's Status Updated");
        return redirect('admin/size'); 
    }
}
