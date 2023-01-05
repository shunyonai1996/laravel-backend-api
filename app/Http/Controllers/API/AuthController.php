<?php

/**
 * ユーザー登録・accessToken発行、ログイン、ログアウト
 * 
 * @version 1.0
 * @author 米内
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * ユーザー登録処理
     * 認証用のaccessTokenを発行
     * 
     * @param \Illuminate\Http\Request
     * @return string|string
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);
    }

    /**
     * ログイン認証処理
     * ログイン時にaccessTokenを発行
     * 
     * @param \Illuminate\Http\Request
     * @return string|mixed 認証情報の保存、ログインユーザー情報のレスポンス
     */
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    /**
     * ログアウト
     * SessionStrageのaccessTokenを削除
     * 
     * @param \Illuminate\Http\Request
     * @return string|string ログアウト完了メッセージ
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
