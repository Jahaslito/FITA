<?php

namespace App\Http\Controllers;

use App\Models\TempraryEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Response;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update_personal_details(Request $request){
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required',
            'date_of_birth'=>'required',
            'address'=>'required',
        ]
        );
        
        $userId= Auth::user()->id;
        $user= User::find($userId);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        $user->save();

        return "success";
    }
    public function change_password(Request $request){
        $request->validate([
            'current_password'=>'required',
            'new_password'=>'required',
            'verify_password'=>'required',
        ]
        );
        $userId= Auth::user()->id;
        $user= User::find($userId);

        //checking if the current password keyed in by the user is correct
        if (!Hash::check($request->current_password, $user->password) ) {
            return "WP"; //wrong password
        }
      
        //checking if the new password and verify password are the same
        if ($request->new_password!=$request->verify_password) {
            return "MP"; //password mismatch
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return "success";
    }

    public function change_email(Request $request){
        // $request->validate([
        //     'email'=>'required|email',
        // ]);
        $rules = array( 'email'=>'required|email');
        $validator = Validator::make($request->all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 400); // 400 being the HTTP code for an invalid request.
        }
        // return Response::json(array('success' => true), 200);

        $user= User::where("email",$request->email)->first();
        if($user!=null){
            return "Email already exists";
        }

        $userId= Auth::user()->id;
        $temporaryEmail= new TempraryEmail();
        $temporaryEmail->temporary_email= $request->email;
        $temporaryEmail->is_verified= 0;
        $temporaryEmail->user_id= $userId;

        $temporaryEmail->save();
        return 'success';

    }
}
