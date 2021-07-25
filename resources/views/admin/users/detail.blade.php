@extends('layouts.app')
@section('title', 'Detail User')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Users</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Detail User</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <tbody>
                                    <tr>
                                        <th style="width:150px;">ID</th>
                                        <td style="width:1px;">:</td>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIP</th>
                                        <td>:</td>
                                        <td>{{ $user->nip }}</td>
                                    </tr>
                                    <tr>
                                        <th>User ID</th>
                                        <td>:</td>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>:</td>
                                        <td>{{ $user->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan Terakhir</th>
                                        <td>:</td>
                                        <td>{{ $user->pendidikan_terakhir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td>{{ ($user->alamat) ? "$user->alamat" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <td>:</td>
                                        <td>{{ ($user->telp) ? "$user->telp" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hp</th>
                                        <td>:</td>
                                        <td>{{ ($user->hp) ? "$user->hp" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>:</td>
                                        <td>{{ $user->agama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Aktif</th>
                                        <td>:</td>
                                        <td>{{ ($user->aktif === "Y") ? "Yes" : "No" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Level</th>
                                        <td>:</td>
                                        <td>{{ ($user->level === 1) ? "Administrator" : "Staff Kampus" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>:</td>
                                        <td>{{ $user->created_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td>:</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($user->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>:</td>
                                        <td>{{ ($user->last_update_user) ? "$user->last_update_user" : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated Date</th>
                                        <td>:</td>
                                        <td>{{ ($user->updated_at) ? date('d-m-Y H:i:s', strtotime($user->updated_at)) : "-" }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type='button' class="btn btn-primary btn-sm edit-user">Edit</button>
                        <button class="btn btn-danger btn-flat btn-sm remove-user" data-id="{{ $user->id }}" data-username="{{ $user->username }}" data-action="{{ route('users.destroy',$user->id) }}">Delete</button>
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
            window.location = `${SITEURL}/user/users-list`;
        });
        let id = '{{ $user->id }}';
        $('.edit-user').on('click', function() {
            window.location = `${SITEURL}/user/user-edit/${id}`;
        });

        $("body").on("click",".remove-user", function() {
            let current_object = $(this);
            let userID = $(this).data("username");
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover data " + userID + "!",
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