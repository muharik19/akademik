<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\Lecturer;
use App\Course;
use App\Classe;
use App\Major;
date_default_timezone_set("Asia/Jakarta");

class JadwalKuliahController extends Controller
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
            $majors = Major::select(['id', 'kode_jurusan', 'nama_jurusan', 'prodi_id']);
            return datatables()->of($majors)
            ->addColumn('action', 'staff.jadwal.action')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('staff.jadwal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $prodi_id)
    {
        $detailmajor = DB::table('majors')
        ->where('id', $id)
        ->select('id', 'prodi_id', 'nama_jurusan')
        ->first();
        $lecturer = Lecturer::where('aktif', 'Y')->get();
        $course   = Course::where('prodi_id', $prodi_id)->get();
        $classe   = Classe::where('jurusan_id', $id)->get();

        return view('staff.jadwal.add', compact('detailmajor', 'lecturer', 'course', 'classe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $prodi_id)
    {
        $user_name = Auth::user()->username;
        $this->validate($request, [
            'mata_kuliah'     => 'required',
            'kategori_jadwal' => 'required',
            'ruang'           => 'required',
            'kelas'           => 'required',
            'hari'            => 'required',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required',
            'dosen'           => 'required'
        ]);
        $schedule = Schedule::create([
            'jurusan_id'      => $id,
            'makul_id'        => $request->get('mata_kuliah'),
            'kategori_jadwal' => $request->get('kategori_jadwal'),
            'ruang'           => $request->get('ruang'),
            'kelas_id'        => $request->get('kelas'),
            'hari'            => $request->get('hari'),
            'jam_mulai'       => Str::of($request->get('jam_mulai'))->replace(' ', ''),
            'jam_selesai'     => Str::of($request->get('jam_selesai'))->replace(' ', ''),
            'dosen_id'        => $request->get('dosen'),
            'created_user'    => $user_name,
            'updated_at'      => null
          ]);
        if($schedule) {
            alert()->success('Success','Saved');
            return redirect('/staff/jadwal/jadwal-detail/'.$id.'/prodi/'.$prodi_id);
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
        $detailmajor = DB::table('majors')
        ->where('id', $id)
        ->select('id', 'prodi_id', 'nama_jurusan')
        ->first();

        if(request()->ajax()) {
            $schedules = DB::table('schedules AS a')
            ->join('courses AS b', 'a.makul_id', '=', 'b.id')
            ->join('lecturers AS c', 'a.dosen_id', '=', 'c.id')
            ->join('classes AS d', 'a.kelas_id', '=', 'd.id')
            ->where('a.jurusan_id', $id)
            ->select(['a.id', 'a.jurusan_id', 'b.prodi_id', 'b.nama_makul', 'a.kategori_jadwal', 'a.ruang', 'd.nama_kelas', 'a.hari', 'a.jam_mulai', 'a.jam_selesai', 'c.nama_dosen'])
            ->get();
            return datatables()->of($schedules)
            ->addColumn('action', 'staff.jadwal.detail.action')
            ->addColumn('mergeColumn', function ($row) {
                return $row->jam_mulai . ' s/d ' . $row->jam_selesai;
                // return date('h:i', strtotime($row->jam_mulai)) . ' s/d ' . date('h:i', strtotime($row->jam_selesai));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('staff.jadwal.detail', compact('detailmajor'));
    }

    public function detailJadwalKuliah($id)
    {
        $schedules = DB::table('schedules AS a')
        ->join('courses AS b', 'a.makul_id', '=', 'b.id')
        ->join('lecturers AS c', 'a.dosen_id', '=', 'c.id')
        ->join('classes AS d', 'a.kelas_id', '=', 'd.id')
        ->join('majors AS e', 'a.jurusan_id', '=', 'e.id')
        ->join('studyprograms AS f', 'b.prodi_id', '=', 'f.id')
        ->join('lecturers AS g', 'f.ka_prodi', '=', 'g.id')
        ->where('a.id', $id)
        ->select('a.id', 'a.jurusan_id', 'b.prodi_id', 'f.kode_prodi', 'f.nama_prodi', 'b.nama_makul', 'e.nama_jurusan AS jurusan', 'a.kategori_jadwal', 'a.ruang', 'd.nama_kelas', 'a.hari', 'a.jam_mulai', 'a.jam_selesai', 'c.kode_dosen', 'c.nama_dosen', 'g.nama_dosen AS ka_prodi', 'g.kode_dosen AS nip_prodi', 'a.created_user', 'a.last_update_user', 'a.created_at', 'a.updated_at')
        ->first();
        return view('staff.jadwal.detail.detail', compact('schedules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $jurusan_id, $prodi_id)
    {
        // $detailmajor = DB::table('majors')
        // ->where('id', $jurusan_id)
        // ->select('id', 'prodi_id', 'nama_jurusan')
        // ->first();
        $schedule = DB::table('schedules AS a')
        ->join('majors AS b', 'a.jurusan_id', '=', 'b.id')
        ->where('a.id', $id)
        ->select('a.id', 'b.nama_jurusan', 'b.prodi_id', 'a.jurusan_id', 'a.makul_id', 'a.kategori_jadwal', 'a.ruang', 'a.kelas_id', 'a.hari', 'a.jam_mulai', 'a.jam_selesai', 'a.dosen_id')
        ->first();
        $lecturer = Lecturer::where('aktif', 'Y')->get();
        $course   = Course::where('prodi_id', $prodi_id)->get();
        $classe   = Classe::where('jurusan_id', $jurusan_id)->get();
        // $schedule = Schedule::where('id', $id)->first();

        return view('staff.jadwal.edit', compact('lecturer', 'course', 'classe', 'schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $jurusan_id, $prodi_id)
    {
        $user_name = Auth::user()->username;
        $this->validate($request, [
            'mata_kuliah'     => 'required',
            'kategori_jadwal' => 'required',
            'ruang'           => 'required',
            'kelas'           => 'required',
            'hari'            => 'required',
            'jam_mulai'       => 'required',
            'jam_selesai'     => 'required',
            'dosen'           => 'required'
        ]);

        $schedule                   = Schedule::find($id);
        $schedule->jurusan_id       = $jurusan_id;
        $schedule->makul_id         = $request->get('mata_kuliah');
        $schedule->kategori_jadwal  = $request->get('kategori_jadwal');
        $schedule->ruang            = $request->get('ruang');
        $schedule->kelas_id         = $request->get('kelas');
        $schedule->hari             = $request->get('hari');
        $schedule->jam_mulai        = Str::of($request->get('jam_mulai'))->replace(' ', '');
        $schedule->jam_selesai      = Str::of($request->get('jam_selesai'))->replace(' ', '');
        $schedule->dosen_id         = $request->get('dosen');
        $schedule->last_update_user = $user_name;
        
        $schedule->save();
        alert()->success('Updated','Successfully');
        return redirect('/staff/jadwal/jadwal-detail/'.$jurusan_id.'/prodi/'.$prodi_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $jurusan_id, $prodi_id)
    {
        Schedule::where('id', $id)->delete();
        alert()->success('Success','Deleted');
        return redirect('/staff/jadwal/jadwal-detail/'.$jurusan_id.'/prodi/'.$prodi_id);
    }
}
