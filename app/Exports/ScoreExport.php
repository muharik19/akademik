<?php

namespace App\Exports;

use App\Score;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class ScoreExport implements FromCollection
class ScoreExport implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;

    public function __construct(string $nim)
    {
        $this->nim = $nim;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Score::all();
    // }

    public function view(): view
    {
        $data = DB::table('students AS a')
                    ->join('studyprograms AS b', 'a.prodi_id', '=', 'b.id')
                    ->join('majors AS c', 'a.jurusan_id', '=', 'c.id')
                    ->join('classes AS d', 'a.kelas_id', '=', 'd.id')
                    ->where('a.nim', $this->nim)
                    ->select('a.nim', 'a.nama_mahasiswa', 'a.tempat_lahir', 'a.tanggal_lahir', 'b.nama_prodi', 'c.nama_jurusan')
                    ->first();
        $sqlNilai = DB::table('scores AS a')
                        ->join('courses AS b', 'a.makul_id', '=', 'b.id')
                        ->where('a.nim', $this->nim)
                        ->select('b.kode_makul', 'b.nama_makul', 'a.uts', 'a.uas', 'a.nilai', 'a.sks', 'a.mutu')
                        ->get();

        return view('staff.nilai.excel.laporan-nilai', [
            'data'  => $data,
            'nilai' => $sqlNilai
        ]);
    }
    
    public function registerEvents(): array
    {
        return [

        ];
    }
}
