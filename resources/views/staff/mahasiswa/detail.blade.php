@extends('layouts.app')
@section('title', 'Detail Mahasiswa')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Mahasiswa</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Mahasiswa</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <tbody>
                                    <tr>
                                        <th style="width:180px;">ID</th>
                                        <td style="width:1px;">:</td>
                                        <td>{{ $studentdetail->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIM</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->nim }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->nama_mahasiswa }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->tempat_lahir }}, {{ date('d-m-Y', strtotime($studentdetail->tanggal_lahir)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td>{{ ($studentdetail->alamat) ? "$studentdetail->alamat" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <td>:</td>
                                        <td>{{ ($studentdetail->telp) ? "$studentdetail->telp" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hp</th>
                                        <td>:</td>
                                        <td>{{ ($studentdetail->hp) ? "$studentdetail->hp" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->agama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>:</td>
                                        <td>{{ ($studentdetail->jk === "L") ? "Laki-laki" : "Perempuan" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Aktif</th>
                                        <td>:</td>
                                        <td>{{ ($studentdetail->aktif === "Y") ? "Yes" : "No" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Prodi</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->kode_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Prodi</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->nama_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->kode_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->nama_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>:</td>
                                        <td>{{ ($studentdetail->kategori_kelas === "REG") ? "Regular" : "Eksekutif/Karyawan" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Foto</th>
                                        <td>:</td>
                                        <td><img src="data:image/png;base64, {{ $studentdetail->foto }}" width="300px" height="250px" alt="" /></td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>:</td>
                                        <td>{{ $studentdetail->created_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($studentdetail->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>:</td>
                                        <td>{{ ($studentdetail->last_update_user) ? "$studentdetail->last_update_user" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated Date</th>
                                        <td>:</td>
                                        <td>{{ ($studentdetail->updated_at) ? date('d-m-Y H:i:s', strtotime($studentdetail->updated_at)) : "-" }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type='button' class="btn btn-primary btn-sm" id="edit-mhs">Edit</button>
                        <button class="btn btn-danger btn-flat btn-sm" id="remove-mhs" data-id="{{ $studentdetail->id }}" data-nim="{{ $studentdetail->nim }}" data-action="{{ route('students.destroy',$studentdetail->id) }}">Delete</button>
                        <button type='button' class="btn btn-secondary btn-sm" id="cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page content -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#cancel').on('click', function() {
            window.location = `${SITEURL}/mahasiswa/mahasiswa-list`;
        });
        let id = '{{ $studentdetail->id }}';
        $('#edit-mhs').on('click', function() {
            window.location = `${SITEURL}/mahasiswa/mahasiswa-edit/${id}`;
        });

        $("body").on("click","#remove-mhs", function() {
            let current_object = $(this);
            let nimMhs = $(this).data("nim");
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover data " + nimMhs + "!",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                cancelButtonText: 'No, cancel please!',
                confirmButtonText: 'Yes, delete it!',
            }, function (result) {
                if (result) {
                    let action = current_object.attr('data-action');
                    let token  = jQuery('meta[name="csrf-token"]').attr('content');
                    let id     = current_object.attr('data-id');

                    $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                    $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
    });
</script>
@endsection
