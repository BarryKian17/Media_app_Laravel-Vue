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
                <h3 class="card-title font-weight-bold">Category List</h3>

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
                      <th>Category ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Created at</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($category as $c)
                    <tr>
                        <td>{{ $c->category_id }}</td>
                        <td>{{ $c->title }}</td>
                        <td>{{ $c->description }}</td>
                        <td>{{ $c->created_at->format('j-F-Y') }}</td>
                        <td>
                          <a href="{{ route('admin#categoryUpdatePage',$c->category_id) }}"><button class="btn btn-sm text-white" style="background: rgb(128, 93, 66)"><i class="fas fa-edit"></i></button></a>
                          <a href="{{ route('admin#categoryDelete',$c->category_id) }}"><button class="btn btn-sm  text-white" style="background: rgb(251, 68, 68)"><i class="fas fa-trash-alt"></i></button></a>
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
                        <h3 class="card-title font-weight-bold pt-2">Category Update</h3>
                        <span class="" style="margin-left: 13rem"><a href="{{ route('admin#category') }}"><button class="btn text-white" style="background: rgb(128, 93, 66)">Add Category + </button></a></span>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-2 px-3">
                <form action="{{ route('admin#categoryUpdate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror " id="exampleFormControlInput1" value="{{ old('title',$data->title) }}">
                        @error('title')
                        <div class="is-invalid">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                        <textarea name="description" id="" class="form-control  @error('description') is-invalid @enderror ">{{ old('title',$data->description) }}</textarea>
                        @error('description')
                        <div class="is-invalid">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    </div>

                        <div class="text-center">
                            <button class="btn w-25 text-white" style="background: rgb(128, 93, 66)">Update <i class="mx-1 fas fa-arrow-alt-circle-up"></i></button>
                        </div>
                </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
@endsection
