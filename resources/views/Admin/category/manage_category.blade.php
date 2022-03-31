@extends('admin.layout')
@section('page_title','Manage Category')
@section('category_select','active')
@section('container')
<h1 class="mb10">Manage Category</h1>
<a href="{{url('admin/category')}}" class="mb10">
    <button class="btn btn-success">Back</button>
</a>
<div class="row">
    <div class="col-lg-12"> 
    
        <div class="card">
            <div class="card-body">
                <form action="{{route('category.manage_category_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="category" class="control-label mb-1">Category Name</label>
                        <input id="category" name="category" type="text" class="form-control" aria-required="true" aria-invalid="false" value={{$category_name}}>
                        <span class="err-msg">@error('category'){{$message}}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                        <input id="category_slug" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value={{$category_slug}}>
                        <span class="err-msg">@error('category_slug'){{$message}}@enderror</span>

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

@endsection;