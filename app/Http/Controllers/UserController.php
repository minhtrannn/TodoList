<?php

namespace App\Http\Controllers;
use App\Helpers\Response;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (!($token = JWTAuth::attempt($credentials))) {
            return Response::dataError('Đăng nhập không thành công. Vui lòng thử lại');
        }

        return Response::data($token);
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required| unique:users| max:255',
            'email' => 'required| unique:users',
            'password' => 'required'
        ]);
        if ($validation->fails()){
            return Response::dataError($validation->errors()->first());
        }
        $user = $this->userRepository->store($request);
        return Response::data(new UserResource($user));
    }

    public function getUserInfo(Request $request){
        $user = Auth::user();
        return Response::data(new UserResource($user));
    }



}
