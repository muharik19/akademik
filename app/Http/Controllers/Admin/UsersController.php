<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\LastEducation;
date_default_timezone_set("Asia/Jakarta");

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $users = User::select(['id', 'username', 'nama_lengkap', 'level', 'aktif']);
            return datatables()->of($users)
            ->addColumn('action', 'admin.users.action')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last_educations = LastEducation::all();
        return view('admin.users.add', compact('last_educations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // https://morioh.com/p/d69187a9554c SOLVED
        $user_name = Auth::user()->username;
        $this->validate($request, [
            'nip'             => 'required',
            'nama_lengkap'    => 'required',
            'agama'           => 'required',
            'email'           => 'required|unique:users',
            'confirm_email'   => 'same:email',
            'aktif'           => 'required',
            'level'           => 'required',
            'username'        => 'required',
            'password'        => 'required',
            'repeat_password' => 'same:password',
            'pendidikan'      => 'required'
        ]);
        $user = User::create([
            'nip'          => $request->get('nip'),
            'nama_lengkap' => $request->get('nama_lengkap'),
            'alamat'       => $request->get('alamat'),
            'telp'         => $request->get('telp'),
            'hp'           => $request->get('phone'),
            'agama'        => $request->get('agama'),
            'email'        => $request->get('email'),
            'aktif'        => $request->get('aktif'),
            'level'        => $request->get('level'),
            'username'     => $request->get('username'),
            'password'     => bcrypt($request->get('password')),
            'pendidikanID' => $request->get('pendidikan'),
            'created_user' => $user_name,
            'updated_at' => null
          ]);
        if($user) {
            alert()->success('Success','Saved');
            return redirect('/admin/user/users-list');
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
        // enable query
        // DB::enableQueryLog();
        $user = DB::table('users AS a')
        ->join('last_educations AS b', 'a.pendidikanID', '=', 'b.id')
        ->where('a.id', $id)
        ->select('a.id', 'a.nip', 'a.username', 'a.nama_lengkap', 'a.alamat', 'a.telp', 'a.hp', 'a.agama', 'a.email', 'a.aktif', 'a.level', 'a.created_user', 'a.last_update_user', 'a.created_at', 'a.updated_at', 'b.pendidikan_terakhir')
        ->first();
        // print query
        // dd(DB::getQueryLog());
        // $user = User::where('id', $id)->first();
        // dump($user);
        return view('admin.users.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $last_educations = LastEducation::all();
        $user = User::where('id', $id)->first();
        return view('admin.users.edit', compact('user', 'last_educations'));
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
        $user_name = Auth::user()->username;
        $pass = $request->get('password');
        if(!is_null($pass)){
            $this->validate($request, [
                'nip'             => 'required',
                'nama_lengkap'    => 'required',
                'agama'           => 'required',
                'email'           => 'required',
                'aktif'           => 'required',
                'level'           => 'required',
                'username'        => 'required',
                'password'        => 'required',
                'repeat_password' => 'same:password',
                'pendidikan'      => 'required'
            ]);
        } else {
            $this->validate($request, [
                'nip'           => 'required',
                'nama_lengkap'  => 'required',
                'agama'         => 'required',
                'email'         => 'required',
                'aktif'         => 'required',
                'level'         => 'required',
                'username'      => 'required',
                'pendidikan'    => 'required'
            ]);
        }

        $user                   = User::find($id);
        $user->nip              = $request->get('nip');
        $user->nama_lengkap     = $request->get('nama_lengkap');
        $user->alamat           = $request->get('alamat');
        $user->telp             = $request->get('telp');
        $user->hp               = $request->get('phone');
        $user->agama            = $request->get('agama');
        $user->email            = $request->get('email');
        $user->aktif            = $request->get('aktif');
        $user->level            = $request->get('level');
        $user->pendidikanID     = $request->get('pendidikan');
        $user->last_update_user = $user_name;

        if(!is_null($pass)){
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();
        alert()->success('Updated','Successfully');
        return redirect('/admin/user/users-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        alert()->success('Success','Deleted');
        return redirect('/admin/user/users-list');
    }
}
