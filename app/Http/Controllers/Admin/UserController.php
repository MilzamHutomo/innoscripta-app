<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::notAdmin()->get();

        $roles = User::TYPE_AVAILABLE;

        auth()->user()->append('is_admin')->toArray();

        $data = [
            'roles',
            'users'
        ];

        return Inertia::render('Admin/Users', compact($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            ...$request->all(), 
            'password' => Hash::make('password')
        ];

        User::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        $roles = User::TYPE_AVAILABLE;

        $data = [
            'roles',
            'user'
        ];

        return Inertia::render('Admin/Users/Show', compact($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->all());

        return redirect()->back();
    }
}
