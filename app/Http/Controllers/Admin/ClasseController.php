<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Major;
use App\Classe;
date_default_timezone_set("Asia/Jakarta");

class ClasseController extends Controller
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
            $classes = DB::table('classes AS a')
            ->join('majors AS b', 'a.jurusan_id', '=', 'b.id')
            ->select('a.id', 'a.nama_kelas', 'b.nama_jurusan', 'a.aktif')
            ->get();
            return datatables()->of($classes)
            ->addColumn('action', 'admin.kelas.action')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $major = Major::where('aktif', 'Y')
        ->orderBy('nama_jurusan', 'asc')
        ->get();
        return view('admin.kelas.add', compact('major'));
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
            'jurusan' => 'required',
            'nama_kelas' => 'required|unique:classes',
            'aktif'      => 'required'
        ]);
        $kelas = Classe::create([
            'jurusan_id'   => $request->get('jurusan'),
            'nama_kelas'   => $request->get('nama_kelas'),
            'aktif'        => $request->get('aktif'),
            'created_user' => $user_name,
            'updated_at'   => null
          ]);
        if($kelas) {
            alert()->success('Success','Saved');
            return redirect('/admin/kelas/kelas-list');
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
        $kelas = DB::table('classes AS a')
        ->join('majors AS b', 'a.jurusan_id', '=', 'b.id')
        ->join('studyprograms AS c', 'b.prodi_id', '=', 'c.id')
        ->join('lecturers AS d', 'c.ka_prodi', '=', 'd.id')
        ->where('a.id', $id)
        ->select('a.id', 'a.nama_kelas', 'a.created_user', 'a.last_update_user', 'a.created_at', 'a.updated_at', 'a.aktif', 'b.kode_jurusan', 'b.nama_jurusan' , 'c.kode_prodi', 'c.nama_prodi', 'd.kode_dosen', 'd.nama_dosen')
        ->first();
        return view('admin.kelas.detail', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $major = Major::where('aktif', 'Y')
        ->orderBy('nama_jurusan', 'asc')
        ->get();
        $editkelas = Classe::where('id', $id)->first();
        return view('admin.kelas.edit', compact('editkelas', 'major'));
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
            'jurusan'    => 'required',
            'nama_kelas' => 'required',
            'aktif'      => 'required'
        ]);

        $kelas                   = Classe::find($id);
        $kelas->jurusan_id       = $request->get('jurusan');
        $kelas->nama_kelas       = $request->get('nama_kelas');
        $kelas->aktif            = $request->get('aktif');
        $kelas->last_update_user = $user_name;

        $kelas->save();
        alert()->success('Updated','Successfully');
        return redirect('/admin/kelas/kelas-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Classe::where('id', $id)->delete();
        alert()->success('Success','Deleted');
        return redirect('/admin/kelas/kelas-list');
    }
}
