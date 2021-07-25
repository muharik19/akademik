@extends('layouts.app')
@section('title', 'Jadwal Kuliah')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Jadwal Kuliah</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Jadwal Kuliah {{ $schedules->jurusan }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <tbody>
                                    <tr>
                                        <th style="width:150px;">ID</th>
                                        <td style="width:1px;">:</td>
                                        <td>{{ $schedules->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Prodi</th>
                                        <td>:</td>
                                        <td>{{ $schedules->kode_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Prodi</th>
                                        <td>:</td>
                                        <td>{{ $schedules->nama_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Dosen Prodi</th>
                                        <td>:</td>
                                        <td>{{ $schedules->nip_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Dosen Prodi</th>
                                        <td>:</td>
                                        <td>{{ $schedules->ka_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $schedules->jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mata Kuliah</th>
                                        <td>:</td>
                                        <td>{{ $schedules->nama_makul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori Jadwal</th>
                                        <td>:</td>
                                        <td>{{ ($schedules->kategori_jadwal === 'REG') ? "Regular" : "Eksekutif/Karyawan" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ruang</th>
                                        <td>:</td>
                                        <td>{{ $schedules->ruang }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>:</td>
                                        <td>{{ $schedules->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hari</th>
                                        <td>:</td>
                                        <td>{{ $schedules->hari }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jam</th>
                                        <td>:</td>
                                        <td>{{ $schedules->jam_mulai }} s/d {{ $schedules->jam_selesai }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIP/Kode Dosen</th>
                                        <td>:</td>
                                        <td>{{ $schedules->kode_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dosen</th>
                                        <td>:</td>
                                        <td>{{ $schedules->nama_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>:</td>
                                        <td>{{ $schedules->created_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($schedules->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>:</td>
                                        <td>{{ ($schedules->last_update_user) ? "$schedules->last_update_user" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated Date</th>
                                        <td>:</td>
                                        <td>{{ ($schedules->updated_at) ? date('d-m-Y H:i:s', strtotime($schedules->updated_at)) : "-" }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type='button' class="btn btn-primary btn-sm" id="edit-jadwal">Edit</button>
                        <button class="btn btn-danger btn-flat btn-sm" id="remove-jadwal" data-id="{{ $schedules->id }}" data-kategori_jadwal="{{ $schedules->kategori_jadwal }}" data-action="{{ route('delete',[$schedules->id,$schedules->jurusan_id,$schedules->prodi_id]) }}">Delete</button>
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
        let id = '{{ $schedules->id }}'
        let jurusanID = '{{ $schedules->jurusan_id }}';
        let prodi = '{{ $schedules->prodi_id }}';

        $('#cancel').on('click', function() {
            window.location = `${SITEURL}/jadwal/jadwal-detail/${jurusanID}/prodi/${prodi}`;
        });

        $('#edit-jadwal').on('click', function() {
            window.location = `${SITEURL}/jadwal/jadwal-edit/${id}/jurusan/${jurusanID}/prodi/${prodi}`;
        });

        $("body").on("click","#remove-jadwal", function() {
            let current_object = $(this);
            let kodeProdi = $(this).data("kategori_jadwal");
            let status
            if (kodeProdi === "REG") {
                status = "Regular";
            } else {
                status = "Eksekutif/Karyawan";
            }
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover data " + status + "!",
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