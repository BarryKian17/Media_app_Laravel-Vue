@extends('admin.layouts.app')

@section('content')
<div class="col-6 offset-1 mt-1">
    <form action="{{ route('admin#passwordUpdate') }}" method="post">
        @csrf
        <h1 class="text-dark fw-bold text-center">Change Password</h1>
        @if (session('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('updateSuccess') }} <i class="fa fa-check"></i></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if (session('notMatch'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('notMatch') }} <i class="fas fa-exclamation-circle"></i></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="col-10 offset-1">
            <input type="text" name="id" hidden value="{{ Auth::user()->id }}">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="password" name="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror " id="exampleFormControlInput1" value="">
                @error('oldPassword')
                    <div class="is-invalid">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">New Password</label>
                <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror " id="exampleFormControlInput1" value="">
                @error('newPassword')
                <div class="is-invalid">
                    <span class="text-danger">{{ $message }}</span>
                </div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Confirm New Password</label>
                <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror " id="exampleFormControlInput1" value="">
                @error('confirmPassword')
                <div class="is-invalid">
                    <span class="text-danger">{{ $message }}</span>
                </div>
            @enderror
            </div>
        </div>

        <div class="row">
            <div class=" offset-1 ">
                <div class="row">
                    <div class="d-flex">
                        <div class="">
                            <a href="#" >
                                <button type="submit" class="btn px-5 text-center fw-bold mt-3 text-white" style="background: rgb(128, 93, 66)">Update</button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
