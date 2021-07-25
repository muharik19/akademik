@extends('layouts.app')
@section('title', 'Laporan Mahasiswa')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Laporan Mahasiswa</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Laporan Seluruh Data Mahasiswa</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="{{ route('student.export') }}" method="GET" autocomplete="off">
                            @csrf
                            <span class="section">Personal Laporan Mahasiswa</span>
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
                            <div class="field item form-group" style="margin-bottom: 10px; display:none;" id="showStatus">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status Mahasiswa<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control" name="status" id="status" required="required">
                                        <option value="A">All</option>
                                        <option value="Y">Aktif</option>
                                        <option value="N">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3"><br />
                                        <button type="submit" class="btn btn-primary btn-sm">Export</button>
                                        <button type="reset" class="btn btn-secondary btn-sm" id="cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection
@section('script')
<!-- Javascript functions	-->
<script>
    $(document).ready(function() {
        $('#cancel').on('click', function() {
            window.location = `${SITEURL}/home`;
        });

        $('#jurusan').select2({
            width: '100%'
        });

        $('#kelas').select2({
            width: '100%'
        });

        $('#jurusan').change(function() {
            let jurusanID = $('#jurusan').val();
            if (!jurusanID) {
		    	$("#showClass").hide();
                $("#showStatus").hide();
		    } else {
                $("#showClass").show();
                $("#showStatus").show();
                let $select = $('#kelas');
                $("#kelas").val('');
                $('[name="jurusan"]').val(jurusanID);
                $select.html('');
                $.ajax({
                    url: `${SITEURL}/student/student-kelas/${jurusanID}`,
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
    });
</script>
@endsection