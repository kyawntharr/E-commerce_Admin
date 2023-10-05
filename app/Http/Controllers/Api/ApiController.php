<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = JWTAuth::attempt($input);
        if ($jwt_token) {
            return response()->json([
                'con' => true,
                'message' => 'loging success',
                'token' => $jwt_token,
            ]);
        } else {
            return response()->json([
                'con' => false,
                'message' => 'creditial error!',
            ]);
        }
    }

    public function register(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|between:4,20',
            'email' => 'required|email|unique:users',
            'password' => 'required|digits_between:4,20',
            'confirmation_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'con' => false,
                'message' => 'Register Fail!',
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
        return response()->json([
            'con' => true,
            'message' => 'Register success.Please Login.',
        ]);
    }

    public function me()
    {
        return response()->json([
            'con' => true,
            'message' => 'Your Infos',
            'user' => auth()->user(),
        ]);
    }

    public function cats()
    {
        $cats = Category::all();
        return response()->json([
            'con' => true,
            'message' => 'All Categories',
            'categories' => $cats
        ]);
    }

    public function subcats($id){
        $subcats = SubCategory::where('category_id', $id)->get();
        return response()->json([
            'con' => true,
            'message' => 'All Sub Categories',
            'sub_cats' => $subcats
        ]);
    }
}
