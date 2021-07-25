<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;
use App\Major;
use App\StudyProgram;
use App\Lecturer;
date_default_timezone_set("Asia/Jakarta");

class MakulController extends Controller
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
            $courses = DB::table('courses AS a')
            ->join('majors AS b', 'a.jurusan_id', '=', 'b.id')
            ->join('lecturers AS c', 'a.dosen_id', '=', 'c.id')
            ->select('a.id', 'a.kode_makul', 'a.nama_makul', 'a.sks', 'b.nama_jurusan', 'c.kode_dosen')
            ->get();
            return datatables()->of($courses)
            ->addColumn('action', 'admin.makul.action')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.makul.index');
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
        $major = Major::where('aktif', 'Y')
        ->orderBy('nama_jurusan', 'asc')
        ->get();
        $lecturer = Lecturer::where('aktif', 'Y')
        ->orderBy('nama_dosen', 'asc')
        ->get();
        return view('admin.makul.add', compact('lecturer', 'studyprogram', 'major'));
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
            'kode_makul' => 'required|unique:courses',
            'prodi'      => 'required',
            'jurusan'    => 'required',
            'nama_makul' => 'required|unique:courses',
            'semester'   => 'required',
            'sks'        => 'required',
            'dosen'      => 'required'
        ]);
        $course = Course::create([
            'kode_makul'   => $request->get('kode_makul'),
            'prodi_id'     => $request->get('prodi'),
            'jurusan_id'   => $request->get('jurusan'),
            'nama_makul'   => $request->get('nama_makul'),
            'semester'     => $request->get('semester'),
            'sks'          => $request->get('sks'),
            'dosen_id'     => $request->get('dosen'),
            'created_user' => $user_name,
            'updated_at'   => null
          ]);
        if($course) {
            alert()->success('Success','Saved');
            return redirect('/admin/makul/makul-list');
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
        $detailmakul = DB::table('courses AS a')
        ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
        ->join('lecturers AS c', 'a.dosen_id', '=', 'c.id')
        ->join('majors AS d', 'a.jurusan_id', '=', 'd.id')
        ->where('a.id', $id)
        ->select('a.id', 'a.kode_makul', 'a.nama_makul', 'a.semester', 'a.sks', 'a.created_user', 'a.last_update_user', 'a.created_at', 'a.updated_at', 'b.kode_prodi', 'b.nama_prodi', 'c.kode_dosen', 'c.nama_dosen', 'd.kode_jurusan', 'd.nama_jurusan')
        ->first();
        return view('admin.makul.detail', compact('detailmakul'));
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
        $major = Major::where('aktif', 'Y')
        ->orderBy('nama_jurusan', 'asc')
        ->get();
        $lecturer = Lecturer::where('aktif', 'Y')
        ->orderBy('nama_dosen', 'asc')
        ->get();
        $editmakul = Course::where('id', $id)->first();
        return view('admin.makul.edit', compact('studyprogram', 'major', 'lecturer', 'editmakul'));
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
            'kode_makul' => 'required',
            'prodi'      => 'required',
            'jurusan'    => 'required',
            'nama_makul' => 'required',
            'semester'   => 'required',
            'sks'        => 'required',
            'dosen'      => 'required'
        ]);

        $makul                   = Course::find($id);
        $makul->kode_makul       = $request->get('kode_makul');
        $makul->prodi_id         = $request->get('prodi');
        $makul->jurusan_id       = $request->get('jurusan');
        $makul->nama_makul       = $request->get('nama_makul');
        $makul->semester         = $request->get('semester');
        $makul->sks              = $request->get('sks');
        $makul->dosen_id         = $request->get('dosen');
        $makul->last_update_user = $user_name;
        
        $makul->save();
        alert()->success('Updated','Successfully');
        return redirect('/admin/makul/makul-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::where('id', $id)->delete();
        alert()->success('Success','Deleted');
        return redirect('/admin/makul/makul-list');
    }
}
