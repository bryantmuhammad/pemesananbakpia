<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name'      => 'required|max:30|alpha',
                'email'     => 'required|unique:users|email:dns',
                'password'  => 'required',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.alpha'    => 'Nama tidak boleh angka'
            ]
        );
        $validatedData['role'] = 3;
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/customer/login')->with('success', 'Berhasil mendaftarkan akun');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        Gate::authorize('view', $user);
        if (session()->has('success')) {
            Alert::success(session('success'), 'success');
        }

        return view('customer.profile.profile', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->email !== $user->email) {
            $rule['email'] = 'required|unique:users|email:dns';
        }
        $rule = [
            'name'      => 'required|max:30|alpha',
        ];
        $validatedData = $request->validate($rule, [
            'name.required' => 'Nama tidak boleh kosong',
            'name.alpha'    => 'Nama tidak boleh angka'
        ]);

        if ($request->password) {
            $validatedData['password'] = Hash::make($request->password);
        }
        User::where('id_user', $user->id_user)->update($validatedData);

        return redirect('/customer/user/' . $user->id_user)->with('success', 'Profil berhasil diganti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
