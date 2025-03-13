<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    use ApiResponse;
    public function register(Request $request)
    {
        return $this->success(
            'sobuj',
            'all user'
        );
    }
}
