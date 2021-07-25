<table>
    <thead>
        <tr>
            <td colspan="2">Reporting</td>
            <td>: <b>Data Dosen</b></td>
        </tr>
        <tr>
            <th>NO</th>
            <th>NIP</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
            <th>AGAMA</th>
            <th>EMAIL</th>
            <th>JENIS KELAMIN</th>
            <th>TELEPON</th>
            <th>PHONE</th>
            <th>PENDIDIKAN TERAKHIR</th>
            <th>AKTIF</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($lecturers as $lecturer)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $lecturer->kode_dosen }}</td>
            <td>{{ $lecturer->nama_dosen }}</td>
            <td>{{ $lecturer->alamat }}</td>
            <td>{{ $lecturer->agama }}</td>
            <td>{{ $lecturer->email }}</td>
            <td>{{ ($lecturer->jk === 'L') ? "Laki-laki" : "Perempuan" }}</td>
            <td>{{ $lecturer->telp }}</td>
            <td>{{ $lecturer->hp }}</td>
            <td>{{ $lecturer->pendidikan_terakhir }}</td>
            <td>{{ ($lecturer->aktif === 'Y') ? "Ya" : "Tidak" }}</td>
        </tr>
    @endforeach
    </tbody>
</table>