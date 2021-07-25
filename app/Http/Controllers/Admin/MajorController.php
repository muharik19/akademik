<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Major;
use App\StudyProgram;
use App\Lecturer;
date_default_timezone_set("Asia/Jakarta");

class MajorController extends Controller
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
            $majors = DB::table('majors AS a')
            ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
            ->select('a.id', 'a.kode_jurusan', 'a.nama_jurusan', 'a.aktif', 'b.nama_prodi')
            ->get();
            return datatables()->of($majors)
            ->addColumn('action', 'admin.jurusan.action')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.jurusan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studyprogram = StudyProgram::where('aktif', 'Y')
        ->orderBy('nama_prodi', 'asc')
        ->get();
        $lecturer = Lecturer::where('aktif', 'Y')
        ->orderBy('nama_dosen', 'asc')
        ->get();
        return view('admin.jurusan.add', compact('lecturer', 'studyprogram'));
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
            'kode_jurusan' => 'required|unique:majors',
            'nama_jurusan' => 'required|unique:majors',
            'nama_prodi'   => 'required',
            'dosen'        => 'required',
            'aktif'        => 'required'
        ]);
        $major = Major::create([
            'kode_jurusan' => $request->get('kode_jurusan'),
            'nama_jurusan' => $request->get('nama_jurusan'),
            'prodi_id'     => $request->get('nama_prodi'),
            'dosen_id'     => $request->get('dosen'),
            'aktif'        => $request->get('aktif'),
            'created_user' => $user_name,
            'updated_at'   => null
          ]);
        if($major) {
            alert()->success('Success','Saved');
            return redirect('/admin/major/major-list');
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
        $detailmajor = DB::table('majors AS a')
        ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
        ->join('lecturers AS c', 'a.dosen_id', '=', 'c.id')
        ->where('a.id', $id)
        ->select('a.id', 'a.kode_jurusan', 'b.nama_prodi', 'a.nama_jurusan', 'c.nama_dosen', 'a.created_user', 'a.last_update_user', 'a.created_at', 'a.updated_at', 'a.aktif')
        ->first();
        return view('admin.jurusan.detail', compact('detailmajor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studyprogram = StudyProgram::where('aktif', 'Y')
        ->orderBy('nama_prodi', 'asc')
        ->get();
        $lecturer = Lecturer::where('aktif', 'Y')
        ->orderBy('nama_dosen', 'asc')
        ->get();
        $major = Major::where('id', $id)->first();
        return view('admin.jurusan.edit', compact('studyprogram', 'lecturer', 'major'));
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
        $this->validate($request, [
            'kode_jurusan' => 'required',
            'nama_jurusan' => 'required',
            'nama_prodi'   => 'required',
            'dosen'        => 'required',
            'aktif'        => 'required'
        ]);

        $majorchange                   = Major::find($id);
        $majorchange->kode_jurusan     = $request->get('kode_jurusan');
        $majorchange->nama_jurusan     = $request->get('nama_jurusan');
        $majorchange->prodi_id         = $request->get('nama_prodi');
        $majorchange->dosen_id         = $request->get('dosen');
        $majorchange->aktif            = $request->get('aktif');
        $majorchange->last_update_user = $user_name;

        $majorchange->save();
        alert()->success('Updated','Successfully');
        return redirect('/admin/major/major-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Major::where('id', $id)->delete();
        alert()->success('Success','Deleted');
        return redirect('/admin/major/major-list');
    }
}
