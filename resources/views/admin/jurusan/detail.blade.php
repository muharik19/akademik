@extends('layouts.app')
@section('title', 'Detail Jurusan')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Jurusan</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Jurusan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <tbody>
                                    <tr>
                                        <th style="width:150px;">ID</th>
                                        <td style="width:1px;">:</td>
                                        <td>{{ $detailmajor->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $detailmajor->kode_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>:</td>
                                        <td>{{ $detailmajor->nama_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $detailmajor->nama_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>KA Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $detailmajor->nama_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Aktif</th>
                                        <td>:</td>
                                        <td>{{ ($detailmajor->aktif === "Y") ? "Yes" : "No" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>:</td>
                                        <td>{{ $detailmajor->created_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($detailmajor->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>:</td>
                                        <td>{{ ($detailmajor->last_update_user) ? "$detailmajor->last_update_user" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated Date</th>
                                        <td>:</td>
                                        <td>{{ ($detailmajor->updated_at) ? date('d-m-Y H:i:s', strtotime($detailmajor->updated_at)) : "-" }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type='button' class="btn btn-primary btn-sm edit-jurusan">Edit</button>
                        <button class="btn btn-danger btn-flat btn-sm remove-jurusan" data-id="{{ $detailmajor->id }}" data-kode_jurusan="{{ $detailmajor->kode_jurusan }}" data-action="{{ route('majors.destroy',$detailmajor->id) }}">Delete</button>
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
            window.location = `${SITEURL}/major/major-list`;
        });
        let id = '{{ $detailmajor->id }}';
        $('.edit-jurusan').on('click', function() {
            window.location = `${SITEURL}/major/major-edit/${id}`;
        });

        $("body").on("click",".remove-jurusan", function() {
            let current_object = $(this);
            let kodeJurusan = $(this).data("kode_jurusan");
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover data " + kodeJurusan + "!",
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
