@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List</h3>

        <div class="card-tools">
            <form action="{{ route('admin#list') }}" method="GET" class="d-flex border border-0 rounded-right">
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
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Address</th>
              <th></th>
            </tr>
          </thead>
          @foreach ($list as $a)
          <tbody>
            <tr>
              <td>{{ $a->id }}</td>
              <td>{{$a->name}}</td>
              <td>{{ $a->email }}</td>
              <td>{{ $a->phone }}</td>
              <td>{{$a->gender}}</td>
              <td>{{ $a->address }}</td>
              <td>
               <a href="{{ route('admin#delete',$a->id) }}">
                <button class="btn btn-sm bg-danger text-white" @if (Auth::user()->id == $a->id ) hidden  @endif><i class="fas fa-trash-alt"></i></button>
               </a>
              </td>
            </tr>
          </tbody>
          @endforeach

        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
