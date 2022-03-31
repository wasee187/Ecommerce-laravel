<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    
    public function index()
    {   
        $result = Coupon::all();
        return view('admin.coupon.coupon',['data'=>$result]);
    }

    public function manage_coupon(Request $request, $id='')
    {
        if($id > 0){
            $arr = Coupon::where(['id'=>$id])->get();
            $result['id'] = $arr['0']->id;
            $result['title'] = $arr['0']->title;
            $result['code'] = $arr['0']->code;
            $result['value'] = $arr['0']->value;
        }else{
            $result['id'] = 0;
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = '';
        }

        return view('admin.coupon.manage_coupon', $result);
    }

    public function manage_coupon_process(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'code'=> 'required||unique:coupons,code,'.$request->post('id'),
            'value' => 'required',
            //checking coupon code if it is unique and ignoring it corresponding if there is any request for edit
        ]);
 
        if ($validator->fails()) {

            return redirect('admin/coupon/manage_coupon')
                        ->withErrors($validator)
                        ->withInput();

        }
    
        if($request->post('id')>0){
            $coupon = Coupon::find($request->post('id'));
            $message = "Coupon Updated";
        }else{
            $coupon = new Coupon();
            $message = "Coupon Inserted";
        }

        $coupon->title = $request->post('title');
        $coupon->code = $request->post('code');
        $coupon->value = $request->post('value');
        $coupon->status = 1;
        $coupon->save();
        $request->session()->flash('message',$message);
        return redirect('admin/coupon');
    }   

    public function delete(Request $request, $id){
        $data = Coupon::find($id);
        $data->delete();
        $request->session()->flash('message','Coupon Deleted');
        return redirect('admin/coupon');     
    }

    public function status(Request $request, $status, $id){
        $data = Coupon::find($id);
        $data->status = $status;
        $data->save();
        $request->session()->flash('message','Coupon Status Updated');
        return redirect('admin/coupon'); 
    }
}
