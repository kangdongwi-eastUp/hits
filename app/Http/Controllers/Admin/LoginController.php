<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // login form
    public function loginForm()
    {
        if (Auth::guard('hits:admin')->check()) {
            return redirect()->route('admin.apply');
        } else {
            return view('admin.login');
        }
    }

    // login
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make(
          $request->all(),
          [
              'id' => 'required|string|max:45',
              'password' => 'required|string|max:45'
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->toArray()
            ],400);
        }

        if (!Auth::guard('hits:admin')->attempt(['id' => $request->input('id'), 'password' => $request->input('password')])) {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        return response()->json([
            'result' => 'success',
            'data' => Auth::guard('hits:admin')->user()
        ]);
    }

    // logout
    public function logout()
    {
        Auth::guard('hits:admin')->logout();
        return redirect()->route('admin.login');
    }
}
