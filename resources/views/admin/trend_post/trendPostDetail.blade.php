@extends('admin.layouts.app')

@section('content')

<div class="col-12">
    <button class="btn px-3 mb-3 text-white mt-1" onclick="history.back()" style="background: rgb(128, 93, 66)"><i class="	fas fa-arrow-left mx-1"></i>Back</button>
</div>

<div class="col-7">
    <div class="card">
        @if ($post->image == null)
        <img src="{{asset('storage/default.png')}}" alt="" style="max-height: 500px">
        @else
        <img src="{{asset('storage/'.$post->image )}}" alt="" style="max-height: 500px">
        @endif
    </div>
    <!-- /.card -->
  </div>
  <div class="col-5">
    <div class="card">
      <div class="card-header d-flex">
        <h4 class="col-4 font-weight-bold">Post Details</h4>
        <span class="col text-right">{{ $post->post_count }}<i class="fas fa-eye mx-1"></i></span>
</div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-2 px-3">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $post->title }}" disabled>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Category</label>
                <input type="text" class="form-control" disabled value="{{ $post->category_title }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Created_at</label>
                <input type="text" class="form-control" disabled value="{{ $post->created_at->format('j-F-Y') }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Updated_at</label>
                <input type="text" class="form-control" disabled value="{{ $post->updated_at->format('j-F-Y') }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <textarea  id="" class="form-control" disabled>{{ $post->description }}</textarea>
            </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
