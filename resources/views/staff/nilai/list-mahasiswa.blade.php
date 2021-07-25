@extends('layouts.app')
@section('title', 'Management Nilai')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3><span>Management Nilai</span></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Management Nilai Mahasiswa</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="" action="{{ route('score.listshow') }}" method="GET" autocomplete="off">
                        @csrf
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="nim" style="font-size: 16px;">NIM<span class="required">*</span></label>
                            <div class="col-md-2 col-sm-2">
                                <input class="form-control" type="text" name="nim" id="nim" placeholder="NIM" value="{{ old('nim') }}" minlength="10" maxlength="10" required="required" />
                            </div>
                            <button type="submit" class="btn btn-primary" id="cari">Go!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="6">Data Mahasiswa </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> NIM </td>
                                    <td><b>:</b></td>
                                    <td><b>{{ $data->nim }}</b></td>
                                    <td> Jenis Kelamin </td>
                                    <td><b>:</b></td>
                                    <td><b>{{ ($data->jk === 'L') ? "Laki-laki" : "Perempuan" }}</b></td>
                                </tr>
                                <tr>
                                    <td> Nama </td>
                                   <td><b>:</b></td>
                                    <td><b>{{ $data->nama_mahasiswa }}</b></td>
                                    <td> Aktif </td>
                                   <td><b>:</b></td>
                                    <td><b>{{ ($data->aktif === 'Y') ? "Ya" : "Tidak" }}</b></td>
                                </tr>
                                <tr>
                                    <td> Program Studi </td>
                                   <td><b>:</b></td>
                                    <td><b>{{ $data->nama_prodi }}</b></td>
                                    <td> Kategori Kelas </td>
                                   <td><b>:</b></td>
                                    <td><b>{{ ($data->kategori_kelas === 'REG') ? "Regular" : "Eksekutif/Karyawan" }}</b></td>
                                </tr>
                                <tr>
                                    <td> Jurusan </td>
                                   <td><b>:</b></td>
                                    <td><b>{{ $data->nama_jurusan }}</b></td>
                                    <td> Kelas </td>
                                   <td><b>:</b></td>
                                    <td><b>{{ $data->nama_kelas }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="9">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addNilai">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nilai
                                        </button>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="9">Data Nilai Mahasiswa</th>
                                </tr>
                                <tr>
                                    <th style="vertical-align:middle;text-align:center;" rowspan="2">Kode Mata Kuliah</th>
                                    <th style="vertical-align:middle;text-align:center;" rowspan="2">Mata Kuliah</th>
                                    <th style="vertical-align:middle;text-align:center;" rowspan="2">UTS</th>
                                    <th style="vertical-align:middle;text-align:center;" rowspan="2">UAS</th>
                                    <th style="vertical-align:middle;text-align:center;" colspan="3">Kredit</th>
                                    <th style="vertical-align:middle;text-align:center;" rowspan="2">Predikat</th>
                                    <th style="vertical-align:middle;text-align:center;" rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th style="vertical-align:middle;text-align:center;">Nilai</th>
                                    <th style="vertical-align:middle;text-align:center;">SKS</th>
                                    <th style="vertical-align:middle;text-align:center;">Mutu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sksTotal = 0;
                                $mutuPoint = 0;
                                ?>
                                @foreach ($nilai as $rows)
                                    <tr>
                                        <?php
                                            if ($rows->nilai == '4') {
                                                $predikat = 'A';
                                            } else if ($rows->nilai == '3') {
                                                $predikat = 'B';
                                            } else if ($rows->nilai == '2') {
                                                $predikat = 'C';
                                            } else if ($rows->nilai == '1') {
                                                $predikat = 'D';
                                            } else {
                                                $predikat = 'E';
                                            }
                                        ?>
                                        <td style="vertical-align:middle;text-align:center;">{{ $rows->kode_makul }}</td>
                                        <td style="vertical-align:middle;text-align:center;">{{ $rows->nama_makul }}</td>
                                        <td style="vertical-align:middle;text-align:center;">{{ $rows->uts }}</td>
                                        <td style="vertical-align:middle;text-align:center;">{{ $rows->uas }}</td>
                                        <td style="vertical-align:middle;text-align:center;">{{ $rows->nilai }}</td>
                                        <td style="vertical-align:middle;text-align:center;">{{ $rows->sks }}</td>
                                        <td style="vertical-align:middle;text-align:center;">{{ $rows->mutu }}</td>
                                        <td style="vertical-align:middle;text-align:center;">{{ $predikat }}</td>
                                        <td style="vertical-align:middle;text-align:center;">
                                            <button type="button" class="btn btn-warning btn-sm" id="detailEdit" data-toggle="modal" data-target="#editNilai" data-id="{{ $rows->id }}" data-nim="{{ $rows->nim }}" data-makul="{{ $rows->makul_id }}" data-uts="{{ $rows->uts }}" data-uas="{{ $rows->uas }}" data-nilai="{{ $rows->nilai }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" id="remove-nilai" data-id="{{ $rows->id }}" data-nim="{{ $rows->nim }}" data-action="{{ route('deletescore',[$rows->id,$rows->nim]) }}">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    $sksTotal += $rows->sks;
                                    $mutuPoint += $rows->mutu;
                                    ?>
                                @endforeach
                            </tbody>
                            <?php
                            if ($mutuPoint > 0) {
                                $ipk = Round(($mutuPoint / $sksTotal),2);
                            } else {
                                $ipk = 0;
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:210px;">Total SKS</td><td><b>{{ $sksTotal }}</b></td>
                                </tr>
                                <tr>
                                    <td>Total Point</td><td><b>{{ $mutuPoint }}</b></td>
                                </tr>
                                <tr>
                                    <td>Indeks Prestasi Kumulatif (IPK)</td><td><b>{{ $ipk }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table table-bordered">
                            <tbody>
                                <tr>
                                    <th>
                                        <button type="button" class="btn btn-danger btn-sm" id="exportpdf" data-getnim="{{ $data->nim }}" data-action="{{ route('score.exportpdf') }}">
                                            <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Export to PDF
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" id="exportexcel" data-getnim="{{ $data->nim }}" data-action="{{ route('score.exportexcel') }}">
                                            <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Export to Excel
                                        </button>
                                        <!-- <a type="button" href="{{ route('score.exportexcel') }}" target="_blank" class="button" id="exportexcel" data-getnim="{{ $data->nim }}" data-action="{{ route('score.exportexcel') }}">
                                            <span class="glyphicon glyphicon-export" aria-hidden="true"></span> Export to Excel
                                        </a> -->
                                    </th>
					            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<!-- Modal Add Nilai -->
<div class="modal fade" id="addNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Nilai Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('score.store') }}" method="GET" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="nim"><b>NIM<span class="required">*</span></b></label>
                    <input class="form-control" type="text" name="nim" id="nim" value="{{ $data->nim }}" required="required" readonly />
                </div>
                <div class="form-group">
                    <label for="nama"><b>Nama Mahasiswa<span class="required">*</span></b></label>
                    <input class="form-control" type="text" name="nama" id="nama" value="{{ $data->nama_mahasiswa }}" required="required" readonly />
                </div>
                <div class="form-group">
                    <label for="mata_kuliah"><b>Mata Kuliah<span class="required">*</span></b></label>
                    <select class="form-control" name="mata_kuliah" id="mata_kuliah" required="required">
                        <option value="">++ Pilih Makul ++</option>
                        @foreach($makul as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_makul }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="uts"><b>UTS<span class="required">*</span></b></label>
                    <input class="form-control" type="text" name="uts" id="uts" maxlength="3" required="required" />
                </div>
                <div class="form-group">
                    <label for="uas"><b>UAS<span class="required">*</span></b></label>
                    <input class="form-control" type="text" name="uas" id="uas" maxlength="3" required="required" />
                </div>
                <div class="form-group">
                    <label for="nilai"><b>Nilai<span class="required">*</span></b></label>
                    <select class="form-control" name="nilai" id="nilai" required="required">
                        <option value='++'>++ Pilih Nilai Mutu ++</option>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Nilai -->
<div class="modal fade" id="editNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Nilai Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('score.update') }}" method="GET" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="ednim"><b>NIM<span class="required">*</span></b></label>
                    <input class="form-control" type="hidden" name="id" id="edid" required="required" />
                    <input class="form-control" type="text" name="ednim" id="ednim" value="{{ $data->nim }}" required="required" readonly />
                </div>
                <div class="form-group">
                    <label for="nama"><b>Nama Mahasiswa<span class="required">*</span></b></label>
                    <input class="form-control" type="text" name="nama" id="nama" value="{{ $data->nama_mahasiswa }}" required="required" readonly />
                </div>
                <div class="form-group">
                    <label for="edmata_kuliah"><b>Mata Kuliah<span class="required">*</span></b></label>
                    <select class="form-control" name="edmata_kuliah" id="edmata_kuliah" required="required" disabled>
                        @foreach($makul as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_makul }}</option>
                        @endforeach
                    </select>
                    <input class="form-control" type="hidden" name="ed_makul_id" id="ed_makul_id" required="required" />
                </div>
                <div class="form-group">
                    <label for="uts"><b>UTS<span class="required">*</span></b></label>
                    <input class="form-control" type="text" name="eduts" id="eduts" maxlength="3" required="required" />
                </div>
                <div class="form-group">
                    <label for="uas"><b>UAS<span class="required">*</span></b></label>
                    <input class="form-control" type="text" name="eduas" id="eduas" maxlength="3" required="required" />
                </div>
                <div class="form-group">
                    <label for="ednilai"><b>Nilai<span class="required">*</span></b></label>
                    <select class="form-control" name="ednilai" id="ednilai" required="required">
                        <option value='++'>++ Pilih Nilai Mutu ++</option>
                        <option value='0'>0</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- Javascript functions	-->
<script>
    jQuery.fn.ForceNumericOnly = function() {
        return this.each(function() {
            $(this).keydown(function(e) {
                var key = e.charCode || e.keyCode || 0;
                // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                // home, end, period, and numpad decimal
                return (
                    key == 8 || 
                    key == 9 ||
                    key == 13 ||
                    key == 46 ||
                    key == 110 ||
                    key == 190 ||
                    (key >= 35 && key <= 40) ||
                    (key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105)
                );
            });
        });
    };

    $(document).ready(function() {
        $("#uts").ForceNumericOnly();
        $("#uas").ForceNumericOnly();
        $("#nim").ForceNumericOnly();
        $('#mata_kuliah').select2({
            width: '100%'
        });
        $('#nilai').select2({
            width: '100%'
        });

        $(document).on('click', '#detailEdit', function () {
            let id      = $(this).data('id');
            let nim     = $(this).data('nim');
            let makulID = $(this).data('makul');
            let uts     = $(this).data('uts');
            let uas     = $(this).data('uas');
            let nilai   = $(this).data('nilai');

            document.getElementById('ednim').value=nim;
            document.getElementById('edid').value=id;
            document.getElementById('edmata_kuliah').value=makulID;
            document.getElementById('ed_makul_id').value=makulID;
            document.getElementById('eduts').value=uts;
            document.getElementById('eduas').value=uas;
            document.getElementById('ednilai').value=nilai;
            $('#ednilai').select2({
                width: '100%'
            });
        });

        $("body").on("click","#remove-nilai", function() {
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
                    let id     = current_object.attr('data-id');
                    let nim    = current_object.attr('data-nim');

                    $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                    $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                    $('body').find('.remove-form').append('<input name="nim" type="hidden" value="'+nim+'">');
                    $('body').find('.remove-form').submit();
                }
            });
        });

        $(document).on("click", "#exportpdf", function() {
            let current_object = $(this);
            let action = current_object.attr('data-action');
            let token  = jQuery('meta[name="csrf-token"]').attr('content');
            let nim    = current_object.attr('data-getnim');

            $('body').html("<form class='form-inline exprpdf-form' method='post' action='"+action+"'></form>");
            $('body').find('.exprpdf-form').append('<input name="_method" type="hidden" value="post">');
            $('body').find('.exprpdf-form').append('<input name="_token" type="hidden" value="'+token+'">');
            $('body').find('.exprpdf-form').append('<input name="nim" type="hidden" value="'+nim+'">');
            $('body').find('.exprpdf-form').submit();
        });

        $(document).on("click", "#exportexcel", function() {
            let current_object = $(this);
            let action = current_object.attr('data-action');
            let token  = jQuery('meta[name="csrf-token"]').attr('content');
            let nim    = current_object.attr('data-getnim');

            $('body').html("<form class='form-inline exprexcel-form' method='get' action='"+action+"'></form>");
            $('body').find('.exprexcel-form').append('<input name="_method" type="hidden" value="get">');
            $('body').find('.exprexcel-form').append('<input name="_token" type="hidden" value="'+token+'">');
            $('body').find('.exprexcel-form').append('<input name="nim" type="hidden" value="'+nim+'">');
            $('body').find('.exprexcel-form').submit();
            // $('body').html(`<meta http-equiv='refresh' content='0; URL=/staff/mahasiswa/mahasiswa-list-data?_token=${token}&nim=${nim}'>`);
        });
    });
</script>
@endsection