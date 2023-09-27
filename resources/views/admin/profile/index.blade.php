@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-1 mt-1">
    <form action="{{ route('admin#update') }}" method="post">
        @csrf
        <h1 class="text-dark fw-bold text-center">Profile</h1>
        @if (session('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('updateSuccess') }} <i class="fa fa-check"></i></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @foreach ($userInfo as $a)


        <div class="col-10 offset-1">
            <input type="text" name="id" hidden value="{{ $a->id }}">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" name="updateName" class="form-control @error('updateName') is-invalid @enderror " id="exampleFormControlInput1" value="{{ old('updateName',$a->name) }}">
                @error('updateName')
                    <div class="is-invalid">
                        <span class="text-danger">* You need to fill the name *</span>
                    </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="updateEmail" class="form-control @error('updateEmail') is-invalid @enderror " id="exampleFormControlInput1" value="{{ old('updateEmail',$a->email) }}">
                @error('updateEmail')
                <div class="is-invalid">
                    <span class="text-danger">* You need to fill the Email *</span>
                </div>
            @enderror
            </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                <input type="text"name="updatePhone" class="form-control" id="exampleFormControlInput1" value="{{ old('updatePhone',$a->phone) }}">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                <select name="updateGender" class="form-control" id="">
                    <option value="Male" @if ( $a->gender == 'Male' ) selected @endif>Male</option>
                    <option value="Female" @if ( $a->gender == 'Female' ) selected @endif>Female</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                <textarea class="form-control" name="updateAddress" id="exampleFormControlTextarea1" rows="3">{{ old('updateAddress',$a->address) }}</textarea>
              </div>
        </div>
        @endforeach
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
