<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    //HOme
    function index(){
        $id = Auth::user()->id;
        $userInfo = User::where('id',$id)->get();

        return view('admin.profile.index',compact('userInfo'));
    }

    //Data Update
    function infoUpdate(Request $request){
        $this->infoValidate($request);
        $data = [
            'name'=>$request->updateName,
            'email'=>$request->updateEmail,
            'phone'=>$request->updatePhone,
            'gender'=>$request->updateGender,
            'address'=>$request->updateAddress,

        ];

        User::where('id',$request->id)->update($data);
        return back()->with(['updateSuccess'=>'Profile Update Successful']);
    }

    //Password page
    function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    //Password Change
    function passwordUpdate(Request $request){
        $this->passwordValidation($request);
        $user = User::select('password')->where('id',$request->id)->first();
        $dbOldPassword = $user->password;
        if(Hash::check($request->oldPassword, $dbOldPassword)){
            $data = [
                'password'=> Hash::make($request->newPassword)
            ];
            User::where('id',$request->id)->update($data);
            return redirect()->route('admin#changePasswordPage')->with(['updateSuccess'=>'Password Successfully Changed']);
        } else {
            return back()->with(['notMatch'=>'Password did not Match']);
        }

    }

    //Delete Account
    function delete($id){
       User::where('id',$id)->delete();
       return back();
    }

    //info Validation
    private function infoValidate($request){
        Validator::make($request->all(), [
            'updateName' => 'required',
            'updateEmail' => 'required|unique:users,email,'.Auth::user()->id,

        ])->validate();
    }

    //Password Validation
    private function passwordValidation($request){
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|same:newPassword'
        ])->validate();
    }
}
