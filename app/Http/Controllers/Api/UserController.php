<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponse;

    // get all users
    public function users()
    {
        //$user = Auth::user();
        $users = User::all();

        return $this->success(
            $users,
            "All userd fetched successfully",
            200
        );
    }

    // get single user
    public function userEdit($user_id)
    {
        try {
            $user = User::find($user_id);

            if (!$user) {
                return $this->error([], 'User not found', 404);
            }

            return $this->success(
                $user,
                "User fetched successfully",
                200
            );
        } catch (\Exception $e) {
            return $this->error(
                [],
                "Something went wrong",
                500
            );
        }
    }

    // update user
    public function userUpdate(Request $request, $user_id)
    {
        // validate request
        $validated = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'password' => 'required|min:8',
        ]);  

        if ($validated->fails()) {
            return $this->error(
                $validated->errors(),
                "Validation Error",
                422
            );
        }
        
        try {
            // find user
            $user = User::find($user_id);

            if (!$user) {
                return $this->error([], 'User not found', 404);
            }

            // update user
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->zipcode = $request->zipcode;
            $user->country = $request->country;
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->success(
                $user,
                "User updated successfully",
                200
            );
        } catch (\Exception $e) {
            return $this->error(
                [],
                "Something went wrong",
                500
            );
        }
    }

    // delete user
    public function userDelete($user_id)
    {
        try {
            $user = User::find($user_id);

            if (!$user) {
                return $this->error([], 'User not found', 404);
            }

            $user->delete();

            return $this->success(
                [],
                "User deleted successfully",
                200
            );
        } catch (\Exception $e) {
            return $this->error(
                [],
                "Something went wrong",
                500
            );
        }
    }
    
}
