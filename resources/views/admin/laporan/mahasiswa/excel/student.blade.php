<table>
    <thead>
        <tr>
            <td colspan="2">Reporting</td>
            <td>: <b>Data Mahasiswa</b></td>
        </tr>
        <tr>
            <td colspan="2">Jurusan</td>
            <td>: <b>{{ $jurusan->nama_jurusan }}</b></td>
        </tr>
        <tr>
            <td colspan="2">Kelas</td>
            <td>: <b>{{ $kelas->nama_kelas }}</b></td>
        </tr>
        <tr>
            <th>NO</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
            <th>JENIS KELAMIN</th>
            <th>TELEPON</th>
            <th>HP</th>
            <th>AGAMA</th>
            <th>EMAIL</th>
            <th>TEMPAT &amp; TANGGAL LAHIR</th>
            <th>KATEGORI KELAS</th>
            <th>AKTIF</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($students as $student)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $student->nim }}</td>
            <td>{{ $student->nama_mahasiswa }}</td>
            <td>{{ $student->alamat }}</td>
            <td>{{ ($student->jk === 'L') ? "Laki-laki" : "Perempuan" }}</td>
            <td>{{ $student->telp }}</td>
            <td>{{ $student->hp }}</td>
            <td>{{ $student->agama }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->tempat_lahir }}, {{ date('d-m-Y', strtotime($student->tanggal_lahir)) }}</td>
            <td>{{ $student->kategori_kelas }}</td>
            <td>{{ ($student->aktif === 'Y') ? "Ya" : "Tidak" }}</td>
        </tr>
    @endforeach
    </tbody>
</table>