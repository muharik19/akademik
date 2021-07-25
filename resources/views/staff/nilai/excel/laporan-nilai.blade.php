<?php
$lahir   = date('j-F-Y', strtotime($data->tanggal_lahir));
$replace = str_replace('-', ' ', $lahir);
?>
<table>
    <thead>
        <tr>
            <td>NIM</td>
            <td>: <b>{{ $data->nim }}</b></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: <b>{{ $data->nama_mahasiswa }}</b></td>
        </tr>
        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>: <b>{{ $data->tempat_lahir }}, {{ $replace }}</b></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <b>{{ $data->nama_prodi }}</b></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td>: <b>{{ $data->nama_jurusan }}</b></td>
        </tr>
        <tr>
            <th rowspan="2" style="text-align: center;"><div align="center"> Kode Mata Kuliah </div></th>
            <th rowspan="2" style="text-align: center;"><div align="center"> Mata Kuliah </div></th>
            <th rowspan="2" style="text-align: center;"><div align="center"> UTS </div></th>
            <th rowspan="2" style="text-align: center;"><div align="center"> UAS </div></th>
            <th colspan="3" style="text-align: center;"><div align="center"> Kredit </div></th>
            <th rowspan="2" style="text-align: center;"><div align="center"> Predikat </div></th>
        </tr>
        <tr>
            <th style="text-align: center;"><div align="center">Nilai</div></th>
            <th style="text-align: center;"><div align="center">SKS</div></th>
            <th style="text-align: center;"><div align="center">Mutu</div></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sksTotal = 0;
        $mutuPoint = 0;
        ?>
        @foreach ($nilai as $rows)
            <tr>
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
                <td style="text-align: center;">{{ $rows->kode_makul }}</td>
                <td style="text-align: center;">{{ $rows->nama_makul }}</td>
                <td style="text-align: center;">{{ $rows->uts }}</td>
                <td style="text-align: center;">{{ $rows->uas }}</td>
                <td style="text-align: center;">{{ $rows->nilai }}</td>
                <td style="text-align: center;">{{ $rows->sks }}</td>
                <td style="text-align: center;">{{ $rows->mutu }}</td>
                <td style="text-align: center;">{{ $predikat }}</td>
            </tr>
            <?php
            $sksTotal += $rows->sks;
            $mutuPoint += $rows->mutu;
            ?>
        @endforeach
    </tbody>
    <?php
    if ($mutuPoint > 0) {
        $ipk = Round(($mutuPoint / $sksTotal),2);
    } else {
        $ipk = 0;
    }
    ?>
</table>
<table>
    <tbody>
        <tr>
            <td style="width:210px;">Total SKS</td><td><b>{{ $sksTotal }}</b></td>
        </tr>
        <tr>
            <td>Total Point</td><td><b>{{ $mutuPoint }}</b></td>
        </tr>
        <tr>
            <td>Indeks Prestasi Kumulatif (IPK)</td><td><b>{{ $ipk }}</b></td>
        </tr>
    </tbody>
</table>