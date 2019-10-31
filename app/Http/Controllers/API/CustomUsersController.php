<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomUser;

class CustomUsersController extends Controller
{
    public function register(Request $request) {
        $customMessages = [
            'regex' => 'Please enter valid Indonesian phone number e.g +6281706501003'
        ];

        $this->validate($request, [
            'mobile_number' => 'required|unique:custom_users,mobile_number|max:20|regex:/(^([+62])(\d{13})?$)/u',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'date_of_birth' => 'date_format:"Y/m/d"',
            'gender' => 'max:10',
            'email' => 'required|unique:custom_users,email|max:50'
        ], $customMessages);

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

        return response()->json([
            'success' => true,
            'message' => 'register success'
        ]);
    }

    public function login(Request $request) {
        return view('login');
    }
}
