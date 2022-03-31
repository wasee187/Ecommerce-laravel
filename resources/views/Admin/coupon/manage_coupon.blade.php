@extends('admin.layout')
@section('page_title','Manage Coupon')
@section('coupon_select','active')
@section('container')
<h1 class="mb10">Manage Coupon</h1>
<a href="{{url('admin/coupon')}}" class="mb10">
    <button class="btn btn-success">Back</button>
</a>
<div class="row">
    <div class="col-lg-12"> 
    
        <div class="card">
            <div class="card-body">
                <form action="{{route('coupon.manage_coupon_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Coupon Title</label>
                        <input id="title" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" value={{$title}}>
                        <span class="err-msg">@error('title'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="code" class="control-label mb-1">Coupon Code</label>
                        <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value={{$code}}>
                        <span class="err-msg">@error('code'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="value" class="control-label mb-1">Coupon Value</label>
                        <input id="value" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" value={{$value}}>
                        <span class="err-msg">@error('value'){{$message}}@enderror</span>
                    </div>
                    
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                    </div>
                    <input type="hidden" id="id" name="id" value="{{$id}}">
                </form>
            </div>
        </div>
    </div>
</div>      

@endsection