@extends('layouts.app')
@section('title', 'Detail Dosen')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Dosen</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Dosen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <tbody>
                                    <tr>
                                        <th style="width:150px;">ID</th>
                                        <td style="width:1px;">:</td>
                                        <td>{{ $lecturershow->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIP/Kode Dosen</th>
                                        <td>:</td>
                                        <td>{{ $lecturershow->kode_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Dosen</th>
                                        <td>:</td>
                                        <td>{{ $lecturershow->nama_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan Terakhir</th>
                                        <td>:</td>
                                        <td>{{ $lecturershow->pendidikan_terakhir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td>{{ ($lecturershow->alamat) ? "$lecturershow->alamat" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <td>:</td>
                                        <td>{{ ($lecturershow->telp) ? "$lecturershow->telp" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hp</th>
                                        <td>:</td>
                                        <td>{{ ($lecturershow->hp) ? "$lecturershow->hp" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>:</td>
                                        <td>{{ $lecturershow->agama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ $lecturershow->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>:</td>
                                        <td>{{ ($lecturershow->jk === "L") ? "Laki-laki" : "Perempuan" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Aktif</th>
                                        <td>:</td>
                                        <td>{{ ($lecturershow->aktif === "Y") ? "Yes" : "No" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>:</td>
                                        <td>{{ $lecturershow->created_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($lecturershow->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>:</td>
                                        <td>{{ ($lecturershow->last_update_user) ? "$lecturershow->last_update_user" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated Date</th>
                                        <td>:</td>
                                        <td>{{ ($lecturershow->updated_at) ? date('d-m-Y H:i:s', strtotime($lecturershow->updated_at)) : "-" }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type='button' class="btn btn-primary btn-sm edit-dosen">Edit</button>
                        <button class="btn btn-danger btn-flat btn-sm remove-dosen" data-id="{{ $lecturershow->id }}" data-kode_dosen="{{ $lecturershow->kode_dosen }}" data-action="{{ route('lecturer.destroy',$lecturershow->id) }}">Delete</button>
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
            window.location = `${SITEURL}/dosen/dosen-list`;
        });
        let id = '{{ $lecturershow->id }}';
        $('.edit-dosen').on('click', function() {
            window.location = `${SITEURL}/dosen/dosen-edit/${id}`;
        });

        $("body").on("click",".remove-dosen", function() {
            let current_object = $(this);
            let kodeDosen = $(this).data("kode_dosen");
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover data " + kodeDosen + "!",
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