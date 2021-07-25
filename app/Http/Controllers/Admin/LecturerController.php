<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LecturerExport;

class LecturerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.laporan.dosen.index');
    }

    public function export(Request $request)
    {
        // return Excel::download(new LecturerExport($request->get('status')), 'dosen-'. date('Y-m-d') .'.xlsx');
        return (new LecturerExport($request->get('status')))->download('dosen-'. date('Y-m-d') .'.xlsx');
    }
}
