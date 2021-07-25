@extends('layouts.app')
@section('title', 'Detail Mata Kuliah')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Mata Kuliah</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail Mata Kuliah</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <tbody>
                                    <tr>
                                        <th style="width:250px;">ID</th>
                                        <td style="width:1px;">:</td>
                                        <td>{{ $detailmakul->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Makul</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->kode_makul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Program Studi</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->kode_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->nama_prodi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->kode_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Jurusan</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->nama_jurusan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Mata Kuliah</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->nama_makul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Semester</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->semester }}</td>
                                    </tr>
                                    <tr>
                                        <th>SKS (Satuan Kredit Semester)</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->sks }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Dosen</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->kode_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Dosen</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->nama_dosen }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>:</td>
                                        <td>{{ $detailmakul->created_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($detailmakul->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>:</td>
                                        <td>{{ ($detailmakul->last_update_user) ? "$detailmakul->last_update_user" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated Date</th>
                                        <td>:</td>
                                        <td>{{ ($detailmakul->updated_at) ? date('d-m-Y H:i:s', strtotime($detailmakul->updated_at)) : "-" }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type='button' class="btn btn-primary btn-sm edit-makul">Edit</button>
                        <button class="btn btn-danger btn-flat btn-sm remove-makul" data-id="{{ $detailmakul->id }}" data-kode_makul="{{ $detailmakul->kode_makul }}" data-action="{{ route('makul.destroy',$detailmakul->id) }}">Delete</button>
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
            window.location = `${SITEURL}/makul/makul-list`;
        });
        let id = '{{ $detailmakul->id }}';
        $('.edit-makul').on('click', function() {
            window.location = `${SITEURL}/makul/makul-edit/${id}`;
        });

        $("body").on("click",".remove-makul", function() {
            let current_object = $(this);
            let kodeMakul = $(this).data("kode_makul");
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover data " + kodeMakul + "!",
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