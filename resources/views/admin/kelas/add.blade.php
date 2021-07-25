@extends('layouts.app')
@section('title', 'Tambah Kelas')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Kelas</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Tambah Kelas</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="{{ route('classe.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <span class="section">Personal Kelas</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="jurusan">Jurusan<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan" required="required">
                                        <option value="">++ Pilih Jurusan ++</option>
                                        @foreach($major as $majors)
                                            <option value="{{ $majors->id }}">{{ $majors->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jurusan')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_kelas">Nama Kelas<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('nama_kelas') is-invalid @enderror" type="text" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" value="{{ old('nama_kelas') }}" required="required" />
                                    @error('nama_kelas')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Aktif<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="radio col-md-2 col-sm-2">
                                        <label for="yes">
                                            <input type="radio" class="@error('aktif') is-invalid @enderror" name="aktif" id="yes" value="Y" required="required"> Yes
                                        </label>
                                    </div>
                                    <div class="radio col-md-2 col-sm-2">&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="no">
                                            <input type="radio" class="@error('aktif') is-invalid @enderror" name="aktif" id="no" value="N" required="required"> No
                                        </label>
                                    </div>
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
        $('.cancel').on('click', function() {
            window.location = `${SITEURL}/kelas/kelas-list`;
        });
        $('#jurusan').select2({
            width: '100%'
        });
    });
</script>
@endsection