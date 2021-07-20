<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\DataTables\Admin\UsersDataTable;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed'],
            'role' => 'exists:Spatie\Permission\Models\Role,id'
        ]);
        
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'email_verified_at' => now(),
        ]);

        $role = Role::find($validatedData['role']);
        $user->assignRole($role);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Check if a user exists for the email provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response\Json
     */
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if ($user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already exists'
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Email is available'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Ban the specified user from accessing the system.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ban($id)
    {
        $user = User::find($id);
        $user->banned_at = now();
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User banned successfully.');
    }

    /**
     * Un-ban the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unban($id)
    {
        $user = User::find($id);
        $user->banned_at = null;
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User un-banned successfully.');
    }
}
