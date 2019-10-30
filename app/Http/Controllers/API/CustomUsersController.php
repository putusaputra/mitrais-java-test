<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomUser;

class CustomUsersController extends Controller
{
    public function register(Request $request) {
        $this->validate($request, function() {
            'mobile_number' => 'required|unique:custom_users,mobile_number|max:20',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'date_of_birth' => 'date',
            'gender' => 'max:10',
            'email' => 'required|unique:custom_users,email|max:50'
        });

        $customUser = new CustomUser;
        $customUser->mobile_number = $request->mobile_number;
        $customUser->first_name = $request->first_name;
        $customUser->last_name = $request->last_name;
        if ($request->date_of_birth) {
            $customUser->date_of_birth = $request->date_of_birth;
        }
        if ($request->gender) {
            $customUser->gender = $request->gender;
        }
        $customUser->email = $request->email;
        $customUser->save();

        return response->json({
            'success' => true,
            'message' => 'login success'
        });
    }

    public function login(Request $request) {
        if (Session::get('user_id') === null) {
            $customUser = CustomUser::where('mobile_number', $request->mobile_number)
                                    ->where('email', $request->email)
                                    ->first();

            if ($customUser) {
                return response->json({
                    'success' => true,
                    'message' => 'login success'
                });
            }
        } else {
            return response->json({
                'success' => false,
                'message' => 'login failed, your email and mobile number not exist in our database'
            });
        }
    }
}
