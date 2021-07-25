@extends('layouts.app')
@section('title', 'Data Jadwal Kuliah')
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
                <h3>Data Jadwal Kuliah</h3>
            </div>
            <div class="title_right">
                <div class="pull-right">
                    <button type="button" class="btn btn-secondary" id="back-to-jadwal-kuliah"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</button>
                    <button type="button" class="btn btn-primary" id="add-new"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Jadwal Makul</button>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Jurusan : {{ $detailmajor->nama_jurusan }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="list-jadwal" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Makul</th>
                                                <th>Kategori Jadwal</th>
                                                <th>Ruang</th>
                                                <th>Kelas</th>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Dosen</th>
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
        let id = '{{ $detailmajor->id }}';
        let prodi = '{{ $detailmajor->prodi_id }}';

        $('#back-to-jadwal-kuliah').on('click', function() {
            window.location = `${SITEURL}/jadwal/jadwal-list`;
        });

        $('#add-new').on('click', function() {
            window.location = `${SITEURL}/jadwal/jadwal-add-new/${id}/prodi/${prodi}`;
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#list-jadwal').DataTable( {
			"searchDelay": 500,
			"processing": true,
			"serverSide": true,
            "order": [[ 0, 'desc' ]],
			"ajax": {
				"url": `${SITEURL}/jadwal/jadwal-detail/${id}/prodi/${prodi}`,
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
					"data": "nama_makul",
					width: 100
				},
				{
					"data": "kategori_jadwal",
					width: 80,
                    "render": function(data) {
						let jadwal
						if (data === 'REG') {
							jadwal = 'Regular'
						} else {
							jadwal = 'Eksekutif/Karyawan'
						}
						return jadwal
					}
				},
                {
					"data": "ruang",
					width: 30
				},
                {
					"data": "nama_kelas",
					width: 30
				},
                {
					"data": "hari",
					width: 30
				},
                {
					"data": "mergeColumn",
					width: 30
				},
                {
					"data": "nama_dosen",
					width: 100
				},
				{
					"data": "action",
					width: 40
				},
			]
		});
    });
</script>
@endsection