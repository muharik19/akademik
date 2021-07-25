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
        </div>

        <div class="clearfix"></div>
        <!-- DATA SUKSES UPLOAD -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List Mahasiswa File Sukses</h2>
                        <div class="clearfix"></div>
                    </div>
                    <form class="" action="{{ route('students.tomaster') }}" method="POST">
                    @csrf
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="list-sukses" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NIM</th>
                                                <th>NAMA MAHASISWA</th>
                                                <th>ALAMAT</th>
                                                <th>TELP</th>
                                                <th>HP</th>
                                                <th>TMP LAHIR</th>
                                                <th>TGL LAHIR</th>
                                                <th>AGAMA</th>
                                                <th>PRODI</th>
                                                <th>JURUSAN</th>
                                                <th>KELAS</th>
                                                <th>KAKTEGORI KELAS</th>
                                                <th>EMAIL</th>
                                                <th>JK</th>
                                                <th>AKTIF</th>
                                                <th>TGL UPLOAD</th>
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
        <div class="clearfix"></div>
        <!-- DATA GAGAL UPLOAD -->
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List Mahasiswa File Gagal</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="list-gagal" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>KETERANGAN</th>
                                                <th>NIM</th>
                                                <th>NAMA MAHASISWA</th>
                                                <th>ALAMAT</th>
                                                <th>TELP</th>
                                                <th>HP</th>
                                                <th>TMP LAHIR</th>
                                                <th>TGL LAHIR</th>
                                                <th>AGAMA</th>
                                                <th>PRODI</th>
                                                <th>JURUSAN</th>
                                                <th>KELAS</th>
                                                <th>KAKTEGORI KELAS</th>
                                                <th>EMAIL</th>
                                                <th>JK</th>
                                                <th>AKTIF</th>
                                                <th>TGL UPLOAD</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="ln_solid">
                                    <div class="form-group pull-left"><br />
                                        <button type='submit' class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Import to Database</button>
                                        <button class="btn btn-secondary btn-sm" id="batalkan" data-action="{{ route('students.delup') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Batalkan</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#list-sukses').DataTable( {
			"searchDelay": 500,
			"processing": true,
			"serverSide": true,
            "order": [[ 0, 'desc' ]],
			"ajax": {
				"url": `${SITEURL}/mahasiswa/mahasiswa-upload-list-sukses`,
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
					"data": "alamat",
					width: 100
                },
                {
					"data": "telp",
					width: 100
                },
                {
					"data": "hp",
					width: 100
                },
                {
					"data": "tempat_lahir",
					width: 100
                },
                {
					"data": "tanggal_lahir",
					width: 100
                },
                {
					"data": "agama",
					width: 100
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
					"data": "nama_kelas",
					width: 100
                },
                {
					"data": "kategori_kelas",
					width: 100,
                },
                {
					"data": "email",
					width: 100,
				},
                {
					"data": "jk",
					width: 100
				},
				{
					"data": "aktif",
					width: 100
				},
				{
					"data": "tanggal_upload",
					width: 100
				},
			]
        });
        
        $('#list-gagal').DataTable( {
			"searchDelay": 500,
			"processing": true,
			"serverSide": true,
            "order": [[ 0, 'desc' ]],
			"ajax": {
				"url": `${SITEURL}/mahasiswa/mahasiswa-upload-list-gagal`,
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
					"data": "keterangan",
					width: 100
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
					"data": "alamat",
					width: 100
                },
                {
					"data": "telp",
					width: 100
                },
                {
					"data": "hp",
					width: 100
                },
                {
					"data": "tempat_lahir",
					width: 100
                },
                {
					"data": "tanggal_lahir",
					width: 100
                },
                {
					"data": "agama",
					width: 100
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
					"data": "nama_kelas",
					width: 100
                },
                {
					"data": "kategori_kelas",
					width: 100,
                },
                {
					"data": "email",
					width: 100,
				},
                {
					"data": "jk",
					width: 100
				},
				{
					"data": "aktif",
					width: 100
				},
				{
					"data": "tanggal_upload",
					width: 100
				},
			]
        });
        $("body").on("click","#batalkan", function(e) {
            e.preventDefault()
            let current_object = $(this);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover data!",
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

                    $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                    $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
    });
</script>
@endsection