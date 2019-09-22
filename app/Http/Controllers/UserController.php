<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new UserService;
    }

    /**
     * Get metrics for the user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getMetrics(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required|exists:users,username',
        ]);

        if ($validator->fails()) {
            return response([
                'status'    => false,
                'message'   => 'Invalid request.',
                'data'      => [],
                'errors'    => $validator->errors()
            ]);
        }

        $user = User::whereUsername($request->username)->first();
        $metrics = $this->service->getMetrics($user);

        return response([
            'status'    => true,
            'message'   => '',
            'data'      => $metrics
        ]);
    }
}
