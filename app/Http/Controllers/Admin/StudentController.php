<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
// use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\Major;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $major = Major::where('aktif', 'Y')->get();
        return view('admin.laporan.mahasiswa.index', compact('major'));
    }

    public function ajaxKelasMhs($jurusan_id)
    {
        $classes = DB::table('classes')
        ->where('jurusan_id', $jurusan_id)
        ->where('aktif', 'Y')
        ->select('id', 'nama_kelas')
        ->get()
        ->toJson();
        return $classes;
    }

    public function export(Request $request)
    {
        return (new StudentExport($request->get('jurusan'), $request->get('kelas'), $request->get('status')))->download('mahasiswa-'. date('Y-m-d') .'.xlsx');
    }
}
