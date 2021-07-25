<?php

namespace App\Exports;

use App\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\FromCollection;

class StudentExport implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;

    public function __construct(int $jurusan, int $kelas, string $status)
    {
        $this->jurusan = $jurusan;
        $this->kelas   = $kelas;
        $this->status  = $status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Student::all();
    // }

    public function view(): View
    {
        if ($this->status === 'Y' || $this->status === 'N') {
            $jurusan = DB::table('majors')->where('id', $this->jurusan)->select('nama_jurusan')->first();
            $kelas   = DB::table('classes')->where('id', $this->kelas)->select('nama_kelas')->first();
            $dataMhs = Student::where('jurusan_id', $this->jurusan)->where('kelas_id', $this->kelas)->where('aktif', $this->status)
            ->select('nim', 'nama_mahasiswa', 'alamat', 'jk', 'telp', 'hp', 'agama', 'email', 'tempat_lahir', 'tanggal_lahir', 'kategori_kelas', 'aktif')
            ->get();
        } else {
            $jurusan = DB::table('majors')->where('id', $this->jurusan)->select('nama_jurusan')->first();
            $kelas   = DB::table('classes')->where('id', $this->kelas)->select('nama_kelas')->first();
            $dataMhs = Student::where('jurusan_id', $this->jurusan)->where('kelas_id', $this->kelas)
            ->select('nim', 'nama_mahasiswa', 'alamat', 'jk', 'telp', 'hp', 'agama', 'email', 'tempat_lahir', 'tanggal_lahir', 'kategori_kelas', 'aktif')
            ->get();
        }

        return view('admin.laporan.mahasiswa.excel.student', [
            'students' => $dataMhs,
            'jurusan'  => $jurusan,
            'kelas'    => $kelas
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:L1';
                // $event->cells($cellRange, function ($cells) {
                //     $cells->setBackgroud('#008686');
                //     $cells->setAlignment('center');
                // });
                // $styleArray = [
                //     'borders' => [
                //         'outline' => [
                //             'style' => \PhpOffice\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                //             'color' => ['argb' => 'FFFF0000'],
                //         ],
                //     ],
                // ];
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);
            },
        ];
    }
}
