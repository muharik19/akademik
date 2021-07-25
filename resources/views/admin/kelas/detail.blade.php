@extends('layouts.app')
@section('title', 'Detail Kelas')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Kelas</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Kelas</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <tbody>
                                    <tr>
                                        <th style="width:150px;">ID</th>
                                        <td style="width:1px;">:</td>
                                        <td>{{ $kelas->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Kelas</th>
                                        <td>:</td>
                                        <td>{{ $kelas->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $kelas->kode_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $kelas->nama_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Prodi</th>
                                        <td>:</td>
                                        <td>{{ $kelas->kode_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Prodi</th>
                                        <td>:</td>
                                        <td>{{ $kelas->nama_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Dosen</th>
                                        <td>:</td>
                                        <td>{{ $kelas->kode_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>KA Prodi</th>
                                        <td>:</td>
                                        <td>{{ $kelas->nama_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Aktif</th>
                                        <td>:</td>
                                        <td>{{ ($kelas->aktif === "Y") ? "Yes" : "No" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>:</td>
                                        <td>{{ $kelas->created_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($kelas->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>:</td>
                                        <td>{{ ($kelas->last_update_user) ? "$kelas->last_update_user" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated Date</th>
                                        <td>:</td>
                                        <td>{{ ($kelas->updated_at) ? date('d-m-Y H:i:s', strtotime($kelas->updated_at)) : "-" }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type='button' class="btn btn-primary btn-sm edit-kelas">Edit</button>
                        <button class="btn btn-danger btn-flat btn-sm remove-kelas" data-id="{{ $kelas->id }}" data-nama_kelas="{{ $kelas->nama_kelas }}" data-action="{{ route('classe.destroy',$kelas->id) }}">Delete</button>
                        <button type='button' class="btn btn-secondary btn-sm cancel">Cancel</button>
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
        $('.cancel').on('click', function() {
            window.location = `${SITEURL}/kelas/kelas-list`;
        });
        let id = '{{ $kelas->id }}';
        $('.edit-kelas').on('click', function() {
            window.location = `${SITEURL}/kelas/kelas-edit/${id}`;
        });

        $("body").on("click",".remove-kelas", function() {
            let current_object = $(this);
            let namaKelas = $(this).data("nama_kelas");
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover data " + namaKelas + "!",
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