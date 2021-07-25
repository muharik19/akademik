<?php

namespace App\Exports;

use App\Lecturer;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class LecturerExport implements FromCollection, WithHeadings
class LecturerExport implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     if ($this->status === 'Y' || $this->status === 'N') {
    //         $dataDosen = Lecturer::where('aktif', $this->status)
    //         ->join('last_educations', 'lecturers.pendidikanID', '=', 'last_educations.id')
    //         ->select('lecturers.kode_dosen', 'lecturers.nama_dosen', 'lecturers.alamat', 'lecturers.agama', 'lecturers.email', 'lecturers.jk', 'lecturers.telp', 'lecturers.hp', 'last_educations.pendidikan_terakhir', 'lecturers.aktif')
    //         ->get();
    //     } else {
    //         $dataDosen = Lecturer::join('last_educations', 'lecturers.pendidikanID', '=', 'last_educations.id')
    //         ->select('lecturers.kode_dosen', 'lecturers.nama_dosen', 'lecturers.alamat', 'lecturers.agama', 'lecturers.email', 'lecturers.jk', 'lecturers.telp', 'lecturers.hp', 'last_educations.pendidikan_terakhir', 'lecturers.aktif')
    //         ->get();
    //     }
    //     return $dataDosen;
    // }

    // public function headings(): array
    // {
    //     return [
    //         'NIP',
    //         'NAMA',
    //         'ALAMAT',
    //         'AGAMA',
    //         'EMAIL',
    //         'JENIS KELAMIN',
    //         'TELEPON',
    //         'PHONE',
    //         'PENDIDIKAN TERAKHIR',
    //         'AKTIF'
    //     ];
    // }

    public function view(): View
    {
        if ($this->status === 'Y' || $this->status === 'N') {
            $dataDosen = Lecturer::where('aktif', $this->status)
            ->join('last_educations', 'lecturers.pendidikanID', '=', 'last_educations.id')
            ->select('lecturers.kode_dosen', 'lecturers.nama_dosen', 'lecturers.alamat', 'lecturers.agama', 'lecturers.email', 'lecturers.jk', 'lecturers.telp', 'lecturers.hp', 'last_educations.pendidikan_terakhir', 'lecturers.aktif')
            ->get();
        } else {
            $dataDosen = Lecturer::join('last_educations', 'lecturers.pendidikanID', '=', 'last_educations.id')
            ->select('lecturers.kode_dosen', 'lecturers.nama_dosen', 'lecturers.alamat', 'lecturers.agama', 'lecturers.email', 'lecturers.jk', 'lecturers.telp', 'lecturers.hp', 'last_educations.pendidikan_terakhir', 'lecturers.aktif')
            ->get();
        }

        return view('admin.laporan.dosen.excel.dosen', [
            'lecturers' => $dataDosen
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:K1';
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
