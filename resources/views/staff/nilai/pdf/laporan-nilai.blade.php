<!DOCTYPE html>
<html>
<head>
	<title>Laporan Nilai Mahasiswa</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th {
			font: small-caps 12px Georgia, serif;
		}
        hr.header {
            border: 1px solid black;
            border-radius: 1px;
        }
        footer {
            font: small-caps 12px Georgia, serif;
            position: fixed;
            left: 0px;
            bottom: -100px;
            right: 0px;
            height: 150px;
        }
        table.table-bordered.table-sm > thead > tr > th {
            border:1px solid black;
        }
        table.table-bordered.table-sm > tbody > tr > td {
            border:1px solid black;
        }
	</style>
    <table>
        <tbody>
            <tr>
                <th style="width:100px;">NIM</th>
                <td style="width:10px;"><b>:</b></td>
                <td><b>{{ $mahasiswa->nim }}</b></td>
            </tr>
            <tr>
                <th>Nama Mahasiswa</th>
                <td><b>:</b></td>
                <td><b>{{ $mahasiswa->nama_mahasiswa }}</b></td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td><b>:</b></td>
                <td><b>{{ $mahasiswa->nama_prodi }}</b></td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td><b>:</b></td>
                <td><b>{{ $mahasiswa->nama_jurusan }}</b></td>
            </tr>
        </tbody>
    </table>
    <hr class="header">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th><div align="center">No</th>
                <th><div align="center">Kode MK </div></th>
                <th><div align="center">Mata Kuliah </div></th>
                <th><div align="center">UTS </div></th>
                <th><div align="center">UAS </div></th>
                <th><div align="center">Nilai</div></th>
                <th><div align="center">SKS</div></th>
                <th><div align="center">Mutu</div></th>
                <th><div align="center">Predikat </div></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=1;
                $totSKS = 0;
                $totPoint = 0;
            ?>
            @foreach($nilai as $rows)
                <?php
                    if ($rows->nilai == '4') {
                        $predikat = 'A';
                    } else if ($rows->nilai == '3') {
                        $predikat = 'B';
                    } else if ($rows->nilai == '2') {
                        $predikat = 'C';
                    } else if ($rows->nilai == '1') {
                        $predikat = 'D';
                    } else {
                        $predikat = 'E';
                    }
                ?>
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $rows->kode_makul }}</td>
                    <td>{{ $rows->nama_makul }}</td>
                    <td>{{ $rows->uts }}</td>
                    <td>{{ $rows->uas }}</td>
                    <td>{{ $rows->nilai }}</td>
                    <td>{{ $rows->sks }}</td>
                    <td>{{ $rows->mutu }}</td>
                    <td>{{ $predikat }}</td>
                </tr>
                <?php
                    $totSKS += $rows->sks;
                    $totPoint += $rows->mutu;
                ?>
			@endforeach
        </tbody>
        <?php
            if ($totPoint > 0) {
                $ipk = Round(($totPoint / $totSKS),2);
            } else {
                $ipk = 0;
            }
        ?>
    </table>
    <table>
        <tbody>
            <tr>
                <td style="width:175px;">Total SKS</td>
                <td style="width:10px;">:</td>
                <td>{{ $totSKS }}</td>
            </tr>
            <tr>
                <td>Total Point</td>
                <td>:</td>
                <td>{{ $totPoint }}</td>
            </tr>
            <tr>
                <td>Indeks Prestasi Kumulatif (IPK)</td>
                <td>:</td>
                <td>{{ $ipk }}</td>
            </tr>
        </tbody>
    </table>
    <footer>
        <hr class="header">
        <table>
            <tbody>
                <tr>
                    <td>Dicetak tanggal</td>
                    <td style="width:10px;">:</td>
                    <td><?= date( 'd-m-Y, H:i:s'); ?></td>
                </tr>
            </tbody>
        </table>
    </footer>
</body>
</html>