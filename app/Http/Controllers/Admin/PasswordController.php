<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\CurrentPasswordForGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * 비밀번호 변경 폼을 보여줍니다.
     */
    public function edit()
    {
        return view('admin.password.edit');
    }

    /**
     * 관리자 비밀번호를 업데이트합니다.
     */
    public function update(Request $request)
    {
        $user = Auth::guard('hits:admin')->user();


        // 유효성 검사

        $validated = $request->validate(
            [
                'current_password' => ['required', 'current_password:hits:admin'],
                'password' => [
                    'required',
                    'confirmed',
                    'max:16',   // 최대 16자
                    Password::min(8)    // 최소 8자
                        ->letters() // 최소 하나의 영문자 포함
                    ,
                    // 숫자 또는 특수문자 중 하나를 포함하는지 확인하는 커스텀 규칙
                    function (string $attribute, $value, \Closure $fail) {
                        if (!preg_match('/[0-9]/', $value)) {
                            $fail('비밀번호는 숫자를 필수로 포함해야 합니다.');
                        }
                        if (!preg_match('/[\W_]/', $value)) {
                            $fail('비밀번호는 특수문자를 필수로 포함해야 합니다.');
                        }
                    },

                ],

            ],
            [
                'current_password.required' => '현재 비밀번호를 입력해주세요.',
                'password.required' => '새 비밀번호를 입력해주세요.',
                'password.max' => '비밀번호는 최대 :max자까지 가능합니다.',
                'password.min' => '비밀번호는 최소 :min자이상 입력해주세요.',
                'password.confirmed' => '새 비밀번호 확인이 일치하지 않습니다.'
            ]
        );


        // 비밀번호 업데이트
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        // 로그아웃 처리
        Auth::guard('hits:admin')->logout();

        // 로그인 페이지로 리다이렉트하며 alert 메시지 전달
        return redirect()->route('admin.login')
            ->with('msg', '비밀번호가 성공적으로 변경되었습니다. 다시 로그인해주세요.');
    }
}
