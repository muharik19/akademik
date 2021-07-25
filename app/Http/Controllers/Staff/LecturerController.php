<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Lecturer;
use App\LastEducation;
date_default_timezone_set("Asia/Jakarta");

class LecturerController extends Controller
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
            $dosen = Lecturer::select(['id', 'kode_dosen', 'nama_dosen', 'jk', 'aktif']);
            return datatables()->of($dosen)
            ->addColumn('action', 'staff.dosen.action')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('staff.dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last_educations = LastEducation::all();
        return view('staff.dosen.add', compact('last_educations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_name = Auth::user()->username;
        $this->validate($request, [
            'kode_dosen'    => 'required|unique:lecturers',
            'nama_dosen'    => 'required',
            'agama'         => 'required',
            'email'         => 'required|unique:users',
            'confirm_email' => 'same:email',
            'aktif'         => 'required',
            'jk'            => 'required',
            'pendidikan'    => 'required'
        ]);
        $dosenstore = Lecturer::create([
            'kode_dosen'   => $request->get('kode_dosen'),
            'nama_dosen'   => $request->get('nama_dosen'),
            'alamat'       => $request->get('alamat'),
            'telp'         => $request->get('telp'),
            'hp'           => $request->get('phone'),
            'agama'        => $request->get('agama'),
            'email'        => $request->get('email'),
            'aktif'        => $request->get('aktif'),
            'jk'           => $request->get('jk'),
            'pendidikanID' => $request->get('pendidikan'),
            'created_user' => $user_name,
            'updated_at'   => null
          ]);
        if($dosenstore) {
            alert()->success('Success','Saved');
            return redirect('/staff/dosen/dosen-list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lecturershow = DB::table('lecturers AS a')
        ->join('last_educations AS b', 'a.pendidikanID', '=', 'b.id')
        ->where('a.id', $id)
        ->select('a.id', 'a.kode_dosen', 'a.nama_dosen', 'a.alamat', 'a.jk', 'a.telp', 'a.hp', 'a.agama', 'a.email', 'a.aktif', 'a.created_user', 'a.last_update_user', 'a.created_at', 'a.updated_at', 'b.pendidikan_terakhir')
        ->first();
        return view('staff.dosen.detail', compact('lecturershow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $last_educations = LastEducation::all();
        $dosenedit = Lecturer::where('id', $id)->first();
        return view('staff.dosen.edit', compact('dosenedit', 'last_educations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_name = Auth::user()->username;
        $this->validate($request, [
            'kode_dosen'    => 'required',
            'nama_dosen'    => 'required',
            'agama'         => 'required',
            'email'         => 'required',
            'aktif'         => 'required',
            'jk'            => 'required',
            'pendidikan'    => 'required'
        ]);
        $dosen                   = Lecturer::find($id);
        $dosen->kode_dosen       = $request->get('kode_dosen');
        $dosen->nama_dosen       = $request->get('nama_dosen');
        $dosen->alamat           = $request->get('alamat');
        $dosen->telp             = $request->get('telp');
        $dosen->hp               = $request->get('phone');
        $dosen->agama            = $request->get('agama');
        $dosen->email            = $request->get('email');
        $dosen->aktif            = $request->get('aktif');
        $dosen->pendidikanID     = $request->get('pendidikan');
        $dosen->last_update_user = $user_name;

        $dosen->save();
        alert()->success('Updated','Successfully');
        return redirect('/staff/dosen/dosen-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lecturer::where('id', $id)->delete();
        alert()->success('Success','Deleted');
        return redirect('/staff/dosen/dosen-list');
    }
}
