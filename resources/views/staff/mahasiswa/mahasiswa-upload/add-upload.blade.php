@extends('layouts.app')
@section('title', 'Tambah Mahasisa (Upload Excel)')
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

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Tambah Mahasiswa (Upload Excel)</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {{ Form::open(array('route' => 'students.import', 'method' => 'post', 'files' => true)) }}
                            @csrf
                            <span class="section">Personal Mahasiswa (Upload Excel)</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="prodi">Program Studi<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('prodi') is-invalid @enderror" name="prodi" id="prodi" required="required">
                                        <option value="">++ Pilih Program Studi ++</option>
                                        @foreach($programstudi as $last_row)
                                            <option value="{{ $last_row->id }}">{{ $last_row->nama_prodi }}</option>
                                        @endforeach
                                    </select>
                                    @error('prodi')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="jurusan">Jurusan<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan" required="required">
                                        <option value="">++ Pilih Jurusan ++</option>
                                        @foreach($major as $rows)
                                            <option value="{{ $rows->id }}">{{ $rows->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jurusan')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas">Kelas<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('kelas') is-invalid @enderror" name="kelas" id="kelas" required="required">
                                        <option value="">++ Pilih Kelas ++</option>
                                        @foreach($kelas as $class_row)
                                            <option value="{{ $class_row->id }}">{{ $class_row->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelas')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="upload_excel">Pilih File (Excel 2007 Only (.xlsx))<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('upload_excel') is-invalid @enderror" type="file" name="upload_excel" id="upload_excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" value="{{ old('upload_excel') }}" required="required" />
                                    @error('upload_excel')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3"><br />
                                        <button type='submit' class="btn btn-primary btn-sm">Save</button>
                                        <button type='reset' class="btn btn-secondary btn-sm" id="cancel">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <marquee>Anda tidak dapat melakukan upload foto mahasiswa pada penambahan jenis ini, jika ingin melakukan upload foto, dapat Anda masukkan secara manual satu per satu</marquee>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection
@section('script')
<script src="{{ asset('assets/vendors/validator/multifield.js') }}"></script>
<script src="{{ asset('assets/vendors/validator/validator.js') }}"></script>

<!-- Javascript functions	-->
<script>
    $(document).ready(function() {
        $('#cancel').on('click', function() {
            window.location = `${SITEURL}/mahasiswa/mahasiswa-list`;
        });
        $('#prodi').select2({
            width: '100%'
        });
        $('#jurusan').select2({
            width: '100%'
        });
        $('#kelas').select2({
            width: '100%'
        });
    });
</script>
@endsection