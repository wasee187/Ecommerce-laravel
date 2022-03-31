@extends('admin.layout')
@section('page_title','Manage Color')
@section('color_select','active')
@section('container')
<h1 class="mb10">Manage Size</h1>
<a href="{{url('admin/color')}}" class="mb10">
    <button class="btn btn-success">Back</button>
</a>
<div class="row">
    <div class="col-lg-12"> 
        <div class="card">
            <div class="card-body">
                <form action="{{route('color.manage_color_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Color</label>
                        <input id="color" name="color" type="text" class="form-control" aria-required="true" aria-invalid="false" value={{$color}}>
                        <span class="err-msg">@error('color'){{$message}}@enderror</span>
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