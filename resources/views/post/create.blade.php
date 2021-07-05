@extends('layouts.app')

@section('content')
<div class="container">
   <form method="POST" action="/post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-8 offset-md-2">
           <div class="row">
               <h1>Add New Post</h1>
           </div>
           <div class="form-group row">
               <label for="caption">Post Caption</label>
               <input type="text" name="caption" id="Caption" class="form-control @error('caption') is-invalid @enderror"
               value="{{ old('caption')}}" autocomplete="caption" autofocus>
               @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span> 
               @enderror
           </div>
           <div class="row">
               <label for="image">Post Image</label>
               <input type="file" name="image" id="image" class="form-control-file">
               @error('image')
                        <strong>{{ $message }}</strong>                
               @enderror
           </div>
           <div class="row pt-4">
                <button type="submit" class="btn btn-primary">Add New Post</button>
           </div>
       </div>
   </form>
    
</div>
@endsection
