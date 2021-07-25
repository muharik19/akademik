@extends('layouts.app')
@section('title', 'Management Mahasiswa')
@section('css')
<link href="{{ asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Mahasiswa</h3>
            </div>
            <div class="title_right">
                <div class="pull-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#uploadStudents">
                        <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Tarik Menggunakan Upload
                    </button>
                    <!-- <button type="button" class="btn btn-secondary" id="add-new-upload"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Tarik Menggunakan Upload</button> -->
                    <button type="button" class="btn btn-primary" id="add-new-manual"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Masukan Manual</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Informasi Mahasiswa</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="jurusan">Jurusan <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan" required="required">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach($major as $majors)
                                        <option value="{{ $majors->id }}">{{ $majors->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan')
                                    <span class="badge badge-warning">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group" style="margin-bottom: 10px; display:none;" id="showClass">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas">Kelas <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control @error('kelas') is-invalid @enderror" name="kelas" id="kelas" required="required">
                                    
                                </select>
                                @error('kelas')
                                    <span class="badge badge-warning">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="button" class="btn btn-success" id="check">Check</button>
                                <button type="reset" name="reset" id="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="mahasiswa">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Data Mahasiswa</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="list-mahasiswa" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Aktif</th>
                                                <th>Prodi</th>
                                                <th>Jurusan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<!-- Modal -->
<div class="modal fade" id="uploadStudents" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Mahasiswa (Upload Excel)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => 'students.import', 'method' => 'post', 'files' => true)) }}
                @csrf
                <div class="form-group">
                    <label for="prodi"><b>Program Studi<span class="required">*</span></b></label>
                    <select class="form-control" name="prodi" id="prodi_modal" required="required">
                        <option value="">++ Pilih Program Studi ++</option>
                        @foreach($programstudi as $last_row)
                            <option value="{{ $last_row->id }}">{{ $last_row->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jurusan"><b>Jurusan<span class="required">*</span></b></label>
                    <select class="form-control" name="jurusan" id="jurusan_modal" required="required">
                        <option value="">++ Pilih Jurusan ++</option>
                        @foreach($major as $rows)
                            <option value="{{ $rows->id }}">{{ $rows->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas_modal"><b>Kelas<span class="required">*</span></b></label>
                    <select class="form-control" name="kelas" id="kelas_modal" required="required">
                        <option value="">++ Pilih Kelas ++</option>
                        @foreach($kelas as $class_row)
                            <option value="{{ $class_row->id }}">{{ $class_row->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="upload_excel"><b>Pilih File (Excel 2007 Only (.xlsx))<span class="required">*</span></b></label>
                    <input class="form-control" type="file" name="upload_excel" id="upload_excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required="required" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('assets/global/plugins/datatables/all.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('assets/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

<!-- Javascript functions	-->
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add-new-manual').on('click', function() {
            window.location = `${SITEURL}/mahasiswa/mahasiswa-add-new`;
        });

        // $('#add-new-upload').on('click', function() {
        //     window.location = `${SITEURL}/mahasiswa/mahasiswa-add-new-upload`;
        // });

        $('#prodi_modal').select2({
            width: '100%'
        });

        $('#jurusan_modal').select2({
            width: '100%'
        });

        $('#kelas_modal').select2({
            width: '100%'
        });

        $('#jurusan').select2({
            width: '100%'
        });

        $('#kelas').select2({
            width: '100%'
        });

        $("#mahasiswa").hide();
        $('#jurusan').change(function() {
            let jurusanID = $('#jurusan').val();
            if (!jurusanID) {
		    	$("#showClass").hide();
                $("#mahasiswa").hide();
		    } else {
                $("#showClass").show();
                let $select = $('#kelas');
                $("#kelas").val('');
                $('[name="jurusan"]').val(jurusanID);
                $select.html('');
                $.ajax({
                    url: `${SITEURL}/mahasiswa/mahasiswa-kelas/${jurusanID}`,
                    method: "GET",
                    dataType: 'JSON',
                    data :{jurusan:jurusanID},
                    cache:false,
                    success : function(data) {
                        var item = data;
                        $.each(item, function(key,value) {
                            $select.append(`<option value="` + value.id + `">` + value.nama_kelas + `</option>`);
                        });
                    }
                });
            }
        });

        let getMahasiswaList = function(jurusanID, kelasID) {
            $('#list-mahasiswa').DataTable({
                "searchDelay": 500,
                "processing": true,
                "serverSide": true,
                "order": [[ 0, 'desc' ]],
                "ajax": {
                    "url": `${SITEURL}/mahasiswa/mahasiswa-show-list/${jurusanID}/kelas/${kelasID}`,
                    "type": "GET"
                },
                "rowCallback": function (row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                },
                "columns": [
                    {
                        "data": "id",
                        width: 30
                    },
                    {
                        "data": "nim",
                        width: 100
                    },
                    {
                        "data": "nama_mahasiswa",
                        width: 100
                    },
                    {
                        "data": "jk",
                        width: 100,
                        "render": function(data) {
                            let jenis_kelamin
                            if (data === 'L') {
                                jenis_kelamin = 'Laki-laki'
                            } else {
                                jenis_kelamin = 'Perempuan'
                            }
                            return jenis_kelamin
                        }
                    },
                    {
                        "data": "aktif",
                        width: 30,
                        "render": function(data) {
                            let status
                            if (data === "Y") {
                                status = '<span class="badge badge-success" style="font-size:12px;">Yes</span>'
                            } else {
                                status = '<span class="badge badge-danger" style="font-size:12px;">No</span>'
                            }
                            return status
                        }
                    },
                    {
                        "data": "nama_prodi",
                        width: 100
                    },
                    {
                        "data": "nama_jurusan",
                        width: 100
                    },
                    {
                        "data": "action",
                        width: 30
                    },
                ]
            });
        };

        $('#check').click(function(){
            let jurusanID = $('#jurusan').val();
            let kelasID = $('#kelas').val();

            if (!jurusanID && !kelasID) {
		    	$("#mahasiswa").hide();
		    } else {
                $("#mahasiswa").show();
                $('#list-mahasiswa').DataTable().destroy();
                getMahasiswaList(jurusanID, kelasID)
            }
        });

        $('#reset').click(function(){
            $('#jurusan').val('').trigger('change');
            $("#showClass").hide();
            $("#mahasiswa").hide();
        });

        /** SUCCESS GOOD JOBS */
        // $('#check').click(function() {
        //     let jurusanID = $('#jurusan').val();
        //     let kelasID = $('#kelas').val();
        //     if (!jurusanID && !kelasID) {
		//     	$("#mahasiswa").hide();
		//     } else {
        //         $("#mahasiswa").show();
        //         $('[name="jurusan"]').val(jurusanID);
        //         $('[name="kelas"]').val(kelasID);
        //         let $list = $('#list-mahasiswa');
        //         $list.html('');
        //         $.ajax({
        //             url: `${SITEURL}/mahasiswa/mahasiswa-show-list/${jurusanID}/kelas/${kelasID}`,
        //             method: "GET",
        //             dataType: 'JSON',
        //             data :{jurusan:jurusanID, kelas:kelasID},
        //             cache:false,
        //             success : function(data) {
        //                 var item = data;
        //                 var no = 0;
        //                 $.each(item, function(key,value) {
        //                     if (value.jk === 'L') {
        //                         jenisKelamin = 'Laki-laki';
        //                     } else {
        //                         jenisKelamin = 'Perempuan';
        //                     }

        //                     if (value.aktif === 'Y') {
        //                         statusAktif = '<span class="badge badge-success" style="font-size:12px;">Yes</span>';
        //                     } else {
        //                         statusAktif = '<span class="badge badge-danger" style="font-size:12px;">No</span>';
        //                     }
        //                     no++;
        //                     $list.append(`
        //                         <tr>
        //                             <td>`+no+`</td>
        //                             <td>`+value.nim+`</td>
        //                             <td>`+value.nama_mahasiswa+`</td>
        //                             <td>`+jenisKelamin+`</td>
        //                             <td>`+statusAktif+`</td>
        //                             <td>`+value.nama_prodi+`</td>
        //                             <td>`+value.nama_jurusan+`</td>
        //                             <td><button class="btn btn-info" data-id="`+value.id+`">Detail</button></td>
        //                         </tr>
        //                     `);
        //                 });
        //             }
        //         });
        //     }
        // });
    });
</script>
@endsection