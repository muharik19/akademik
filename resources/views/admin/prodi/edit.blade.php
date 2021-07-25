@extends('layouts.app')
@section('title', 'Edit Program Studi')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Program Studi</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Edit Program Studi</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="{{ route('prodi.update',$studyprogram->id) }}" method="POST" autocomplete="off">
                            @method('patch')
                            @csrf
                            <span class="section">Personal Program Studi</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_prodi">Kode Prodi<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('kode_prodi') is-invalid @enderror" type="text" name="kode_prodi" id="kode_prodi" placeholder="Kode Prodi" value="{{ $studyprogram->kode_prodi }}" required="required" />
                                    @error('kode_prodi')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_prodi">Nama Prodi<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('nama_prodi') is-invalid @enderror" name="nama_prodi" id="nama_prodi" placeholder="Nama Prodi" value="{{ $studyprogram->nama_prodi }}" required="required" />
                                    @error('nama_prodi')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="ka_prodi">KA Prodi<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('ka_prodi') is-invalid @enderror" name="ka_prodi" id="ka_prodi" required="required">
                                        <option value="">++ Pilih KA Prodi ++</option>
                                        @foreach($lecturer as $last_row)
                                            <option value="{{ $last_row->id }}" {{ (isset($studyprogram->ka_prodi) && $studyprogram->ka_prodi === $last_row->id) ? 'selected' : '' }}>{{ $last_row->nama_dosen }}</option>
                                        @endforeach
                                    </select>
                                    @error('ka_prodi')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Aktif<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="radio col-md-2 col-sm-2">
                                        <label for="yes">
                                            <input type="radio" class="@error('aktif') is-invalid @enderror" name="aktif" {{ (isset($studyprogram->aktif) && $studyprogram->aktif === 'Y') ? 'checked' : '' }} id="yes" value="Y" required="required"> Yes
                                        </label>
                                    </div>
                                    <div class="radio col-md-2 col-sm-2">&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="no">
                                            <input type="radio" class="@error('aktif') is-invalid @enderror" name="aktif" {{ (isset($studyprogram->aktif) && $studyprogram->aktif === 'N') ? 'checked' : '' }} id="no" value="N" required="required"> No
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
        let id = '{{ $studyprogram->id }}';
        $('.cancel').on('click', function() {
            window.location = `${SITEURL}/prodi/prodi-detail/${id}`;
        });
        $('#ka_prodi').select2({
            width: '100%'
        });
    });
</script>
@endsection