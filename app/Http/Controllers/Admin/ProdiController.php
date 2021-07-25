<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\StudyProgram;
use App\Lecturer;
date_default_timezone_set("Asia/Jakarta");

class ProdiController extends Controller
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
            $prodi = DB::table('studyprograms AS a')
            ->join('lecturers AS b', 'a.ka_prodi', '=', 'b.id')
            ->select('a.id', 'a.kode_prodi', 'a.nama_prodi', 'a.aktif', 'b.nama_dosen')
            ->get();
            return datatables()->of($prodi)
            ->addColumn('action', 'admin.prodi.action')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.prodi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lecturer = Lecturer::where('aktif', 'Y')
        ->orderBy('nama_dosen', 'asc')
        ->get();
        return view('admin.prodi.add', compact('lecturer'));
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
            'kode_prodi' => 'required|unique:studyprograms',
            'nama_prodi' => 'required|unique:studyprograms',
            'ka_prodi'   => 'required',
            'aktif'      => 'required'
        ]);
        $studyProgram = StudyProgram::create([
            'kode_prodi'   => $request->get('kode_prodi'),
            'nama_prodi'   => $request->get('nama_prodi'),
            'ka_prodi'     => $request->get('ka_prodi'),
            'aktif'        => $request->get('aktif'),
            'created_user' => $user_name,
            'updated_at'   => null
          ]);
        if($studyProgram) {
            alert()->success('Success','Saved');
            return redirect('/admin/prodi/prodi-list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudyProgram  $studyProgram
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studyprogram = DB::table('studyprograms AS a')
        ->join('lecturers AS b', 'a.ka_prodi', '=', 'b.id')
        ->where('a.id', $id)
        ->select('a.id', 'a.kode_prodi', 'a.nama_prodi', 'a.created_user', 'a.last_update_user', 'a.created_at', 'a.updated_at', 'a.aktif', 'b.nama_dosen')
        ->first();
        return view('admin.prodi.detail', compact('studyprogram'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudyProgram  $studyProgram
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecturer = Lecturer::where('aktif', 'Y')
        ->orderBy('nama_dosen', 'asc')
        ->get();
        $studyprogram = StudyProgram::where('id', $id)->first();
        return view('admin.prodi.edit', compact('studyprogram', 'lecturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudyProgram  $studyProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_name = Auth::user()->username;
        $this->validate($request, [
            'kode_prodi' => 'required',
            'nama_prodi' => 'required',
            'ka_prodi'   => 'required',
            'aktif'      => 'required'
        ]);

        $studyprodi                   = StudyProgram::find($id);
        $studyprodi->kode_prodi       = $request->get('kode_prodi');
        $studyprodi->nama_prodi       = $request->get('nama_prodi');
        $studyprodi->ka_prodi         = $request->get('ka_prodi');
        $studyprodi->aktif            = $request->get('aktif');
        $studyprodi->last_update_user = $user_name;
        
        $studyprodi->save();
        alert()->success('Updated','Successfully');
        return redirect('/admin/prodi/prodi-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudyProgram  $studyProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudyProgram::where('id', $id)->delete();
        alert()->success('Success','Deleted');
        return redirect('/admin/prodi/prodi-list');
    }
}
