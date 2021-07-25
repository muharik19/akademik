<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Imports\TemptStudentImport;
use Excel;
use App\StudyProgram;
use App\Student;
use App\Classe;
use App\Major;
date_default_timezone_set("Asia/Jakarta");

class StudentController extends Controller
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
        $programstudi = StudyProgram::where('aktif', 'Y')->get();
        $major = Major::where('aktif', 'Y')->get();
        $kelas = Classe::where('aktif', 'Y')->get();
        return view('staff.mahasiswa.index', compact('major', 'programstudi', 'kelas'));
    }

    public function ajaxKelas($jurusan_id)
    {
        $classes = DB::table('classes')
        ->where('jurusan_id', $jurusan_id)
        ->where('aktif', 'Y')
        ->select('id', 'nama_kelas')
        ->get()
        ->toJson();
        return $classes;
    }

    public function ajaxShow($jurusan_id, $kelas_id)
    {
        /** SUCCESS GOOD JOBS */
        // $data = DB::table('students AS a')
        // ->join('majors AS b', 'a.jurusan_id', '=', 'b.id')
        // ->join('studyprograms AS c', 'a.prodi_id', '=', 'c.id')
        // ->where('a.jurusan_id', $jurusan_id)
        // ->where('a.kelas_id', $kelas_id)
        // ->select('a.id', 'a.nim', 'a.nama_mahasiswa', 'a.jk', 'a.aktif', 'c.nama_prodi', 'b.nama_jurusan')
        // ->get()
        // ->toJson();
        // return $data;

        if(request()->ajax()) {
            $data = DB::table('students AS a')
            ->join('majors AS b', 'a.jurusan_id', '=', 'b.id')
            ->join('studyprograms AS c', 'a.prodi_id', '=', 'c.id')
            ->where('a.jurusan_id', $jurusan_id)
            ->where('a.kelas_id', $kelas_id)
            ->select('a.id', 'a.nim', 'a.nama_mahasiswa', 'a.jk', 'a.aktif', 'c.nama_prodi', 'b.nama_jurusan')
            ->get();
            return datatables()->of($data)
            ->addColumn('action', 'staff.mahasiswa.action')
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programstudi = StudyProgram::where('aktif', 'Y')->get();
        $major = Major::where('aktif', 'Y')->get();
        $kelas = Classe::where('aktif', 'Y')->get();
        return view('staff.mahasiswa.add', compact('programstudi', 'major', 'kelas'));
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
            'nim'            => 'required|unique:students',
            'nama_mahasiswa' => 'required',
            'agama'          => 'required',
            'prodi'          => 'required',
            'jurusan'        => 'required',
            'kelas'          => 'required',
            'kategori_kelas' => 'required',
            'foto'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'          => 'required|unique:users',
            'confirm_email'  => 'same:email',
            'aktif'          => 'required',
            'jk'             => 'required'
        ]);
        $file      = $request->file('foto');
        $imagedata = file_get_contents($file);
        $base64    = base64_encode($imagedata);
        $students = Student::create([
            'nim'            => $request->get('nim'),
            'nama_mahasiswa' => $request->get('nama_mahasiswa'),
            'alamat'         => $request->get('alamat'),
            'telp'           => $request->get('telp'),
            'hp'             => $request->get('phone'),
            'agama'          => $request->get('agama'),
            'email'          => $request->get('email'),
            'aktif'          => $request->get('aktif'),
            'jk'             => $request->get('jk'),
            'tempat_lahir'   => $request->get('tempat'),
            'tanggal_lahir'  => $request->get('tanggal_lahir'),
            'prodi_id'       => $request->get('prodi'),
            'jurusan_id'     => $request->get('jurusan'),
            'kelas_id'       => $request->get('kelas'),
            'kategori_kelas' => $request->get('kategori_kelas'),
            'foto'           => $base64,
            'created_user'   => $user_name,
            'updated_at'     => null
          ]);
        if($students) {
            alert()->success('Success','Saved');
            return redirect('/staff/mahasiswa/mahasiswa-list');
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
        $studentdetail = DB::table('students AS a')
        ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
        ->join('majors AS c', 'a.jurusan_id', '=', 'c.id')
        ->join('classes AS d', 'a.kelas_id', '=', 'd.id')
        ->where('a.id', $id)
        ->select('a.id', 'a.nim', 'a.nama_mahasiswa', 'a.alamat', 'a.telp', 'a.hp', 'a.agama', 'a.email', 'a.aktif', 'a.jk', 'a.tempat_lahir', 'a.tanggal_lahir', 'b.kode_prodi', 'b.nama_prodi', 'a.created_user', 'a.last_update_user', 'a.created_at', 'a.updated_at', 'c.kode_jurusan', 'c.nama_jurusan', 'd.nama_kelas', 'a.kategori_kelas', 'a.foto')
        ->first();
        return view('staff.mahasiswa.detail', compact('studentdetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programstudi = StudyProgram::where('aktif', 'Y')->get();
        $major = Major::where('aktif', 'Y')->get();
        $kelas = Classe::where('aktif', 'Y')->get();
        $mhsedit = Student::where('id', $id)->first();
        return view('staff.mahasiswa.edit', compact('mhsedit', 'programstudi', 'major', 'kelas'));
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
            'nama_mahasiswa' => 'required',
            'agama'          => 'required',
            'prodi'          => 'required',
            'jurusan'        => 'required',
            'kelas'          => 'required',
            'kategori_kelas' => 'required',
            'foto'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'          => 'required',
            'aktif'          => 'required',
            'jk'             => 'required'
        ]);

        $file      = $request->file('foto');
        $changeNIM = $request->get('nim_change');

        $studentupdate                   = Student::find($id);
        $studentupdate->nama_mahasiswa   = $request->get('nama_mahasiswa');
        $studentupdate->alamat           = $request->get('alamat');
        $studentupdate->telp             = $request->get('telp');
        $studentupdate->hp               = $request->get('phone');
        $studentupdate->tempat_lahir     = $request->get('tempat');
        $studentupdate->tanggal_lahir    = $request->get('tanggal_lahir');
        $studentupdate->agama            = $request->get('agama');
        $studentupdate->prodi_id         = $request->get('prodi');
        $studentupdate->jurusan_id       = $request->get('jurusan');
        $studentupdate->kelas_id         = $request->get('kelas');
        $studentupdate->kategori_kelas   = $request->get('kategori_kelas');
        $studentupdate->email            = $request->get('email');
        $studentupdate->jk               = $request->get('jk');
        $studentupdate->aktif            = $request->get('aktif');
        $studentupdate->last_update_user = $user_name;

        if(!is_null($file)) {
            $imagedata = file_get_contents($file);
            $base64 = base64_encode($imagedata);
            $studentupdate->foto = $base64;
        }

        if(!is_null($changeNIM)) {
            $studentupdate->nim = $request->get('nim_change');
        }

        $studentupdate->save();
        alert()->success('Updated','Successfully');
        return redirect('/staff/mahasiswa/mahasiswa-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::where('id', $id)->delete();
        alert()->success('Success','Deleted');
        return redirect('/staff/mahasiswa/mahasiswa-list');
    }

    // Mahasiswa Upload Manual
    // public function uploadView()
    // {
    //     $programstudi = StudyProgram::where('aktif', 'Y')->get();
    //     $major = Major::where('aktif', 'Y')->get();
    //     $kelas = Classe::where('aktif', 'Y')->get();
    //     return view('staff.mahasiswa.mahasiswa-upload.add-upload', compact('programstudi', 'major', 'kelas'));
    // }

    public function checkUpload()
    {
        return view('staff.mahasiswa.mahasiswa-upload.before-upload');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'prodi'        => 'required',
            'jurusan'      => 'required',
            'kelas'        => 'required',
            'upload_excel' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('upload_excel')) {
            $prodi_id   = $request->get('prodi');
            $jurusan_id = $request->get('jurusan');
            $kelas_id   = $request->get('kelas');
            $file = $request->file('upload_excel'); //GET FILE
            Excel::import(new TemptStudentImport($prodi_id, $jurusan_id, $kelas_id), $file); //ALHAMDULILAH IMPORT FILE
            // $data = Excel::toArray(new TemptStudentImport($prodi_id, $jurusan_id, $kelas_id), $file);
            // return collect(head($data))
            // ->each(function ($row, $key) {
            //     $user_name  = Auth::user()->username;
            //     $nim        = $row['nim'];
            //     $nama       = $row['nama_mahasiswa'];
            //     $keterangan = 'null';
            //     $cari       = Temp_student_success::where('nim', $nim)->get();
            //     $cariS      = Student::where('nim', $nim)->get();
            //     if (empty($nim)) {
            //         $keterangan = 'Tidak ada NIM';
            //     } else if (empty($nama)) {
            //         $keterangan = 'Tidak ada Nama Lengkap';
            //     } else if (empty($nim) && empty($nama)) {
            //         $keterangan = 'Tidak ada NIM dan Mahasiswa';
            //     } else if ($cari->count() > 0) {
            //         $keterangan = 'Duplikat NIM di Data Excel';
            //     } else if ($cariS->count() > 0) {
            //         $keterangan = 'Duplikat Data NIM di Database';
            //     }
            //     DB::table('temp_students_success')->insert([
            //         'keterangan'     => $keterangan,
            //         'nim'            => $nim,
            //         'nama_mahasiswa' => $nama,
            //         'alamat'         => $row['alamat'],
            //         'jk'             => $row['jk'],
            //         'telp'           => $row['telp'],
            //         'hp'             => $row['hp'],
            //         'agama'          => $row['agama'],
            //         'email'          => $row['email'],
            //         'tempat_lahir'   => $row['tempat_lahir'],
            //         'tanggal_lahir'  => date('Y-m-d', $row['tanggal_lahir']),
            //         // 'prodi_id'       => $prodi_id,
            //         // 'jurusan_id'     => $jurusan_id,
            //         // 'kelas_id'       => $kelas_id,
            //         'kategori_kelas' => $row['kelas'],
            //         'aktif'          => $row['aktif'],
            //         'tanggal_upload' => date('Y-m-d'),
            //         'created_user'   => $user_name,
            //         'updated_at'     => null,
            //         'created_at'    => date('Y-m-d H:i:s')
            //     ]);
            // });
            // return redirect()->back()->with(['success' => 'Upload success']);
            alert()->success('Upload','Successfully');
            return redirect('/staff/mahasiswa/mahasiswa-check-before-upload');
            
        }
        // return redirect()->back()->with(['error' => 'Please choose file before']);
        alert()->error('Oops...','Please choose file before!');
        return redirect('/staff/mahasiswa/mahasiswa-list');
    }

    public function suksesUpload()
    {
        $date = date('Y-m-d');
        if(request()->ajax()) {
            $data = DB::table('temp_students AS a')
            ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
            ->join('majors AS c', 'a.jurusan_id', '=', 'c.id')
            ->join('classes AS d', 'a.kelas_id', '=', 'd.id')
            ->where('a.tanggal_upload', $date)
            ->whereNull('a.keterangan')
            ->select('a.id', 'a.nim', 'a.nama_mahasiswa', 'a.alamat', 'a.telp', 'a.hp', 'a.tempat_lahir', 'a.tanggal_lahir', 'a.agama', 'b.nama_prodi', 'c.nama_jurusan', 'd.nama_kelas', 'a.kategori_kelas', 'a.email', 'a.jk', 'a.aktif', 'a.tanggal_upload')
            ->get();
            return datatables()->of($data)
            ->make(true);
        }
    }

    public function gagalUpload()
    {
        $date = date('Y-m-d');
        if(request()->ajax()) {
            $data = DB::table('temp_students AS a')
            ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
            ->join('majors AS c', 'a.jurusan_id', '=', 'c.id')
            ->join('classes AS d', 'a.kelas_id', '=', 'd.id')
            ->where('a.tanggal_upload', $date)
            ->whereNotNull('a.keterangan')
            ->select('a.id', 'a.keterangan', 'a.nim', 'a.nama_mahasiswa', 'a.alamat', 'a.telp', 'a.hp', 'a.tempat_lahir', 'a.tanggal_lahir', 'a.agama', 'b.nama_prodi', 'c.nama_jurusan', 'd.nama_kelas', 'a.kategori_kelas', 'a.email', 'a.jk', 'a.aktif', 'a.tanggal_upload')
            ->get();
            return datatables()->of($data)
            ->make(true);
        }
    }

    public function saveToMaster()
    {
        $date       = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');
        $user_name  = Auth::user()->username;
        $check      = DB::table('temp_students')->select('keterangan')
                          ->where('tanggal_upload', $date)
                          ->whereNotNull('keterangan')
                          ->get();

        if ($check->count() > 0) {
            alert()->info('Upload','Data Duplikat silahkan upload ulang!.');
        } else {
            $students = DB::table('temp_students')
                            ->where('tanggal_upload', $date)
                            ->whereNull('keterangan')
                            ->get();
            foreach ($students as $rows) {
                $insert_data[] = array(
                    'nim'            => $rows->nim,
                    'nama_mahasiswa' => $rows->nama_mahasiswa,
                    'alamat'         => $rows->alamat,
                    'jk'             => $rows->jk,
                    'telp'           => $rows->telp,
                    'hp'             => $rows->hp,
                    'agama'          => $rows->agama,
                    'email'          => $rows->email,
                    'tempat_lahir'   => $rows->tempat_lahir,
                    'tanggal_lahir'  => $rows->tanggal_lahir,
                    'prodi_id'       => $rows->prodi_id,
                    'jurusan_id'     => $rows->jurusan_id,
                    'kelas_id'       => $rows->kelas_id,
                    'kategori_kelas' => $rows->kategori_kelas,
                    'aktif'          => $rows->aktif,
                    'created_user'   => $user_name,
                    'created_at'     => $created_at
                );
            }
            if(!empty($insert_data)) {
                DB::table('students')->insert($insert_data);
                DB::table('temp_students')->truncate();
                alert()->success('Success','Data Imported successfully');
            } else {
                alert()->error('Oops...','No records data!');
            }
        }
        return redirect('/staff/mahasiswa/mahasiswa-list');
    }

    public function deleteUpload()
    {
        $temp_student = DB::table('temp_students')->count();
        if ($temp_student > 0) {
            DB::table('temp_students')->truncate();
            alert()->success('Success','Proses Upload telah dibatalkan!');
        } else {
            alert()->info('Upload','No records data!');
        }
        return redirect('/staff/mahasiswa/mahasiswa-list');
    }
}
