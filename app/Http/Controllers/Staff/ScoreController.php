<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\ScoreExport;
// use Maatwebsite\Excel\Facades\Excel;
use App\Score;
use App\Course;
use PDF;
date_default_timezone_set("Asia/Jakarta");

class ScoreController extends Controller
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
        return view('staff.nilai.index');
    }

    public function listShow(Request $request)
    {
        // DB::enableQueryLog();
        $nim = $request->get('nim');
        $data = DB::table('students AS a')
                    ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
                    ->join('majors AS c', 'a.jurusan_id', '=', 'c.id')
                    ->join('classes AS d', 'a.kelas_id', '=', 'd.id')
                    ->where('a.nim', $nim)
                    ->select('a.nim', 'a.jurusan_id','a.nama_mahasiswa', 'a.jk', 'a.aktif', 'a.kategori_kelas', 'b.nama_prodi', 'c.nama_jurusan', 'd.nama_kelas')
                    ->first();
        // dd(DB::getQueryLog());
        if (!empty($data)) {
            $check = $data->jurusan_id;
            $makul = DB::table('courses')
                         ->where('jurusan_id', $check)
                         ->select('id', 'nama_makul')
                         ->get();
            $nilai = DB::table('scores AS a')
                        ->join('courses AS b', 'a.makul_id', '=', 'b.id')
                        ->where('a.nim', $nim)
                        ->select('a.id', 'a.nim', 'a.makul_id', 'b.kode_makul', 'b.nama_makul', 'a.uts', 'a.uas', 'a.nilai', 'a.sks', 'a.mutu', 'a.nilai')
                        ->get();
            return view('staff.nilai.list-mahasiswa', compact('data', 'makul', 'nilai'));
        } else {
            alert()->error('Oops...','No records data!');
            return redirect('/staff/nilai/mahasiswa-nilai');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nim'         => 'required',
            'mata_kuliah' => 'required',
            'uts'         => 'required',
            'uas'         => 'required',
            'nilai'       => 'required'
        ]);
        $nimstud    = $request->get('nim');
        $makul_id   = $request->get('mata_kuliah');
        $token      = $request->get('_token');
        $nilaimhs   = $request->get('nilai');
        $checkscore = DB::table('scores')
                          ->where('makul_id', $makul_id)
                          ->where('nim', $nimstud)
                          ->select('makul_id')
                          ->get();
        if ($checkscore->count() > 0) {
            alert()->error('Oops...','Nilai untuk mata kuliah sudah ada.');
            return redirect('/staff/mahasiswa/mahasiswa-list-data?_token='.$token.'&nim='.$nimstud.'');
        } else {
            $makul = DB::table('courses')
                         ->where('id', $makul_id)
                         ->select('sks')
                         ->first();
            $mutu = $makul->sks * $nilaimhs;
            $sksMakul = $makul->sks;
            $addnilai = Score::create([
                'nim'          => $nimstud,
                'makul_id'     => $makul_id,
                'uts'          => $request->get('uts'),
                'uas'          => $request->get('uas'),
                'nilai'        => $nilaimhs,
                'sks'          => $sksMakul,
                'mutu'         => $mutu,
                'created_user' => $user_name,
                'updated_at'   => null
            ]);
            if($addnilai) {
                alert()->success('Success','Saved');
                return redirect('/staff/nilai/mahasiswa-list-data?_token='.$token.'&nim='.$nimstud.'');
            }
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
    public function update(Request $request)
    {
        $user_name = Auth::user()->username;
        $this->validate($request, [
            'eduts'   => 'required',
            'eduas'   => 'required',
            'ednilai' => 'required'
        ]);
        $id       = $request->get('id');
        $nimstud  = $request->get('ednim');
        $makul_id = $request->get('ed_makul_id');
        $token    = $request->get('_token');
        $nilaimhs = $request->get('ednilai');
        $makul = DB::table('courses')
                     ->where('id', $makul_id)
                     ->select('sks', 'nama_makul')
                     ->first();
        $mutu     = $makul->sks * $nilaimhs;
        $sksMakul = $makul->sks;

        $editscore                   = Score::find($id);
        $editscore->uts              = $request->get('eduts');
        $editscore->uas              = $request->get('eduas');
        $editscore->nilai            = $nilaimhs;
        $editscore->mutu             = $mutu;
        $editscore->last_update_user = $user_name;

        $editscore->save();
        alert()->success('Updated','Successfully');
        return redirect('/staff/nilai/mahasiswa-list-data?_token='.$token.'&nim='.$nimstud.'');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $nim)
    {
        $nimstud = $request->get('nim');
        $token   = $request->get('_token');
        // DB::enableQueryLog();
        // $whereArray = array('id' => $id,'nim' => $nim);
        // Score::destroy([$whereArray]);
        // $query = DB::table('scores');
        // foreach($whereArray as $field => $value) {
        //     $query->where($field, $value);
        // }
        // return $query->delete();
        DB::table('scores')
            ->where('id', $id)
            ->where('nim', $nim)
            ->delete();
        // dd(DB::getQueryLog());
        alert()->success('Success','Deleted');
        return redirect('/staff/nilai/mahasiswa-list-data?_token='.$token.'&nim='.$nimstud.'');
    }

    public function exportPDF(Request $request)
    {
        $nim  = $request->get('nim');
        $data = DB::table('students AS a')
                    ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
                    ->join('majors AS c', 'a.jurusan_id', '=', 'c.id')
                    ->join('classes AS d', 'a.kelas_id', '=', 'd.id')
                    ->where('a.nim', $nim)
                    ->select('a.nim', 'a.nama_mahasiswa', 'b.nama_prodi', 'c.nama_jurusan')
                    ->first();
        $sqlNilai = DB::table('scores AS a')
                        ->join('courses AS b', 'a.makul_id', '=', 'b.id')
                        ->where('a.nim', $nim)
                        ->select('b.kode_makul', 'b.nama_makul', 'a.uts', 'a.uas', 'a.nilai', 'a.sks', 'a.mutu')
                        ->get();
        $pdf = PDF::loadView('staff.nilai.pdf.laporan-nilai', ['mahasiswa' => $data, 'nilai' => $sqlNilai]);
        // return $pdf->download('laporan-nilai-pdf');
        return $pdf->stream();
    }

    public function exportExcel(Request $request)
    {
        $nim   = $request->get('nim');
        // $token = $request->get('_token');
        // if ($nim) {
            return (new ScoreExport($nim))->download('IPK_'. $nim .'.xlsx');
        // }
        // return redirect('/staff/nilai/mahasiswa-list-data?_token='.$token.'&nim='.$nim.'');
    }
}
