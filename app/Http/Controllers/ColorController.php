<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index()
    {   
        $result = Color::all();
        return view('admin.color.color',['data'=>$result]);
    }

    public function manage_color(Request $request, $id='')
    {
        if($id > 0){
            $arr = Color::where(['id'=>$id])->get();
            $result['id'] = $arr['0']->id;
            $result['color'] = $arr['0']->color;
            $result['status'] = $arr['0']->status;
        }else{
            $result['id'] = 0;
            $result['color'] = '';
            $result['status'] = '';
        }

        return view('admin.color.manage_color', $result);
    }

    public function manage_color_process(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'color'=> 'required||unique:colors,color,'.$request->post('id'),
            //checking size code if it is unique and ignoring it corresponding if there is any request for edit
        ]);
 
        if ($validator->fails()) {

            return redirect('admin/color/manage_color')
                        ->withErrors($validator)
                        ->withInput();

        }
    
        if($request->post('id')>0){
            $color = Color::find($request->post('id'));
            $message = "Color Updated";
        }else{
            $color = new Color();
            $message = "Color Inserted";
        }

        $color->color = $request->post('color');
        $color->status = 1;
        $color->save();
        $request->session()->flash('message',$message);
        return redirect('admin/color');
    }   

    public function delete(Request $request, $id){
        $data = Color::find($id);
        $data->delete();
        $request->session()->flash('message','Color Deleted');
        return redirect('admin/color');     
    }

    public function status(Request $request, $status, $id){
        $data = Color::find($id);
        $data->status = $status;
        $data->save();
        $request->session()->flash('message',"Color's Status Updated");
        return redirect('admin/color'); 
    }
}
