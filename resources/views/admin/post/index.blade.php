@extends('admin.layouts.app')

@section('content')
<div class="col-6">
@if (session('deleteSuccess'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session('deleteSuccess') }} <i class="fas fa-exclamation-circle"></i></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
</div>

        <div class="col-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title font-weight-bold">Post List</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#category') }}" method="GET" class="d-flex border border-0 rounded-right">
                        @csrf
                        <input type="text" name="key" class="p-1" value="{{ request('key') }}">
                        <button class="btn text-white" style="background: rgb(128, 93, 66)" type="submit" title="Search">
                            <i class="fas fa-search fs-5"></i>
                        </button>
                    </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>Created at</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($post as $p)
                    <tr>
                        <td class="col-2" >
                            @if ($p->image == null)
                            <img src="{{asset('storage/default.png')}}" alt="" style="width: 70px; height: 70px">
                            @else
                            <img src="{{asset('storage/'.$p->image )}}" alt="" style="width: 70px; height: 70px">
                            @endif
                        </td>
                        <td class="col-2">{{ $p->title }}</td>
                        <td class="col-2">{{ $p->category_name }}</td>
                        <td class="col-4">{{ $p->description }}</td>
                        <td class="col-2">{{ $p->created_at->format('j-F-Y') }}</td>
                        <td>
                          <a href="{{ route('admin#postEdit',$p->post_id) }}"><button class="btn btn-sm text-white" style="background: rgb(128, 93, 66)"><i class="fas fa-edit"></i></button></a>
                          <a href="{{ route('admin#postDelete',$p->post_id) }}"><button class="btn btn-sm  text-white" style="background: rgb(251, 68, 68)"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-5">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title font-weight-bold">Post Create</h3>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-2 px-3">
                <form action="{{ route('admin#postCreate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror " id="exampleFormControlInput1" value="">
                        @error('title')
                        <div class="is-invalid">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Category</label>

                        <select name="category" id="" class="form-control">
                            <option value="">Choose Your Category</option>
                            @foreach ($category as $c)
                            <option value="{{ $c->category_id }}">{{ $c->title }}</option>
                            @endforeach
                        </select>


                        @error('category')
                        <div class="is-invalid">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Image</label><br>
                        <input type="file" name="image" class="@error('image') is-invalid @enderror " id="exampleFormControlInput1" value="">
                        @error('image')
                        <div class="is-invalid">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                        <textarea name="description" id="" class="form-control  @error('description') is-invalid @enderror "></textarea>
                        @error('description')
                        <div class="is-invalid">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    </div>

                        <div class="text-center">
                            <button class="btn w-25 text-white" style="background: rgb(128, 93, 66)">Create <i class="mx-1 fas fa-arrow-alt-circle-up"></i></button>
                        </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
@endsection
