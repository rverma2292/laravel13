<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * GET| /api/users
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

    /**
     * POST | api/users
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:6|confirmed|alpha_num',
            'name' => 'required',
        ]);
        $user = User::create($validated);
        return response()->json($user, 201); // 201 Created
    }

    /**
     * // GET /api/users/{id} (Read one)
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * PUT/PATCH /api/users/{id} (Update)
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * DELETE /api/users/{id} (Delete)
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
