@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post List</h3>
{{--
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div> --}}
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Title</th>
              <th>View Count</th>
              <th>Created Data</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $p)
            <tr>
                <td>{{ $p->post_id }}</td>
                <td>
                    @if ($p->image == null)
                    <img src="{{asset('storage/default.png')}}" alt="" style="width: 70px; height: 70px">
                    @else
                    <img src="{{asset('storage/'.$p->image )}}" alt="" style="width: 70px; height: 70px">
                    @endif
                </td>
                <td>{{ $p->title }}</td>
                <td>{{ $p->post_count }} <i class="fas fa-eye"></i></td>
                <td>{{ $p->created_at->format('j-F-Y') }}</td>
                <td>
                    <a href="{{ route('admin#trendDetail',$p->post_id) }}">
                  <button class="btn btn-sm  text-white" style="background: rgb(128, 93, 66)" title="Detail"><i class="fas fa-caret-square-right"></i></button>
                </a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{-- <div class="mx-5">{{ $data->links() }}</div> --}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
