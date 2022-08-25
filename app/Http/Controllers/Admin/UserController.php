<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('success')) {
            Alert::toast(session('success'), 'success');
        }
        return view('admin.admin.index', [
            'admins' => User::where('role', '!=', 3)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.admin.create');
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
                'role'      => 'required'
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'name.alpha'    => 'Nama tidak boleh angka'
            ]
        );
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        if ($validatedData['role'] !== 3)  return redirect('/admin/users')->with('success', 'User berhasil ditambahkan');
        return redirect('/admin/users')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return response()->json($user);
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
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'      => 'required|max:30|alpha',
            'role'      => 'required'
        ];

        if ($request->email !== $user->email) {
            $rules['email'] =  'required|unique:users|email:dns';
        }

        $validatedData = $request->validate($rules, [
            'name.required' => 'Nama tidak boleh kosong',
            'name.alpha'    => 'Nama tidak boleh angka'
        ]);

        if ($request->password) {
            $validatedData['password'] = Hash::make($request->password);
        }

        User::where('id_user', $user->id_user)->update($validatedData);

        return redirect('/admin/users')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::destroy($id);
        return redirect('/admin/users')->with('success', 'User berhasil dihapus');
    }
}
