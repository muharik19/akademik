@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')
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
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Edit Mata Kuliah</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="{{ route('makul.update',$editmakul->id) }}" method="POST" autocomplete="off">
                            @method('patch')
                            @csrf
                            <span class="section">Personal Mata Kuliah</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_makul">Kode Makul<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('kode_makul') is-invalid @enderror" type="text" name="kode_makul" id="kode_makul" value="{{ $editmakul->kode_makul }}" placeholder="Kode Makul" required="required" />
                                    @error('kode_makul')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="prodi">Program Studi<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('prodi') is-invalid @enderror" name="prodi" id="prodi" required="required">
                                        <option value="">++ Pilih Prodi ++</option>
                                        @foreach($studyprogram as $last_rows)
                                            <option value="{{ $last_rows->id }}" {{ (isset($editmakul->prodi_id) && $editmakul->prodi_id === $last_rows->id) ? 'selected' : '' }}>{{ $last_rows->nama_prodi }}</option>
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
                                        @foreach($major as $majors)
                                            <option value="{{ $majors->id }}" {{ (isset($editmakul->jurusan_id) && $editmakul->jurusan_id === $majors->id) ? 'selected' : '' }}>{{ $majors->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jurusan')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_makul">Nama Mata Kuliah<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('nama_makul') is-invalid @enderror" type="text" name="nama_makul" id="nama_makul" value="{{ $editmakul->nama_makul }}"  placeholder="Nama Mata Kuliah" required="required" />
                                    @error('nama_makul')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="semester">Semester<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('semester') is-invalid @enderror" name="semester" id="semester" required="required">
                                        <option value="">++ Pilih Semester ++</option>
                                        <option value="1" {{ (isset($editmakul->semester) && $editmakul->semester === '1') ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ (isset($editmakul->semester) && $editmakul->semester === '2') ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ (isset($editmakul->semester) && $editmakul->semester === '3') ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ (isset($editmakul->semester) && $editmakul->semester === '4') ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ (isset($editmakul->semester) && $editmakul->semester === '5') ? 'selected' : '' }}>5</option>
                                        <option value="6" {{ (isset($editmakul->semester) && $editmakul->semester === '6') ? 'selected' : '' }}>6</option>
                                        <option value="7" {{ (isset($editmakul->semester) && $editmakul->semester === '7') ? 'selected' : '' }}>7</option>
                                        <option value="8" {{ (isset($editmakul->semester) && $editmakul->semester === '8') ? 'selected' : '' }}>8</option>
                                    </select>
                                    @error('semester')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="sks">SKS<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('sks') is-invalid @enderror" type="text" name="sks" id="sks" value="{{ $editmakul->sks }}" placeholder="SKS (Satuan Kredit Semester)" required="required" />
                                    @error('sks')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="dosen">Dosen<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('dosen') is-invalid @enderror" name="dosen" id="dosen" required="required">
                                        <option value="">++ Pilih Dosen ++</option>
                                        @foreach($lecturer as $last_row)
                                            <option value="{{ $last_row->id }}" {{ (isset($editmakul->dosen_id) && $editmakul->dosen_id === $last_row->id) ? 'selected' : '' }}>{{ $last_row->nama_dosen }}</option>
                                        @endforeach
                                    </select>
                                    @error('dosen')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3"><br />
                                        <button type='submit' class="btn btn-primary btn-sm">Save</button>
                                        <button type='reset' class="btn btn-success btn-sm">Reset</button>
                                        <button type='reset' class="btn btn-secondary btn-sm cancel">Cancel</button>
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
<script src="{{ asset('assets/vendors/validator/multifield.js') }}"></script>
<script src="{{ asset('assets/vendors/validator/validator.js') }}"></script>

<!-- Javascript functions	-->
<script>
    $(document).ready(function() {
        let id = '{{ $editmakul->id }}';
        $('.cancel').on('click', function() {
            window.location = `${SITEURL}/makul/makul-detail/${id}`;
        });
        $('#prodi').select2({
            width: '100%'
        });
        $('#jurusan').select2({
            width: '100%'
        });
        $('#semester').select2({
            width: '100%'
        });
        $('#dosen').select2({
            width: '100%'
        });
    });
</script>
@endsection