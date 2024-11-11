<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function getAllUsers()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return $this->returning(true, 'Users Found Successfully', $users, 200);
    }

    public function insertNewUser(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $this->returning(true, 'User Created Successfully', $user, 201);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->returning(false, 'Sorry User Not Found', null, 404);
        }

        $data = $request->all();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $this->returning(true, 'User Updated Successfully', $user, 200);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->returning(false, 'Sorry User Not Found', null, 404);
        }
        $user->delete();
        return $this->returning(true, 'User Deleted Successfully', null, 200);
    }

    public function returning($success, $message, $data, $statusCode)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
