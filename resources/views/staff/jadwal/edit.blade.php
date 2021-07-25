@extends('layouts.app')
@section('title', 'Edit Jadwal Mata Kuliah')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/timepicker/dist/wickedpicker.min.css') }}"/>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Jadwal Mata Kuliah</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Edit Jadwal Mata Kuliah</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="{{ route('change',[$schedule->id,$schedule->jurusan_id,$schedule->prodi_id]) }}" method="POST" autocomplete="off">
                            @method('patch')
                            @csrf
                            <span class="section">Jurusan : {{ $schedule->nama_jurusan }}</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="mata_kuliah">Mata Kuliah<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('mata_kuliah') is-invalid @enderror" name="mata_kuliah" id="mata_kuliah" required="required">
                                        <option value="">++ Pilih Makul ++</option>
                                        @foreach($course as $rows)
                                            <option value="{{ $rows->id }}" {{ (isset($schedule->makul_id) && $schedule->makul_id === $rows->id) ? 'selected' : '' }}>{{ $rows->nama_makul }}</option>
                                        @endforeach
                                    </select>
                                    @error('mata_kuliah')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kategori_jadwal">Kategori Jadwal<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('kategori_jadwal') is-invalid @enderror" name="kategori_jadwal" id="kategori_jadwal" required="required">
                                        <option value="">++ Pilih Kategori Jadwal ++</option>
                                        <option value="REG" {{ (isset($schedule->kategori_jadwal) && $schedule->kategori_jadwal === 'REG') ? 'selected' : '' }}>Regular</option>
						                <option value="EXE" {{ (isset($schedule->kategori_jadwal) && $schedule->kategori_jadwal === 'EXE') ? 'selected' : '' }}>Eksekutif/Karyawan</option>
                                    </select>
                                    @error('kategori_jadwal')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="ruang">Ruang<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('ruang') is-invalid @enderror" name="ruang" id="ruang" placeholder="Ruang" value="{{ $schedule->ruang }}" required="required" />
                                    @error('ruang')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kelas">Kelas<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('kelas') is-invalid @enderror" name="kelas" id="kelas" required="required">
                                        <option value="">++ Pilih Kelas ++</option>
                                        @foreach($classe as $last_rows)
                                            <option value="{{ $last_rows->id }}" {{ (isset($schedule->kelas_id) && $schedule->kelas_id === $last_rows->id) ? 'selected' : '' }}>{{ $last_rows->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelas')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="hari">Hari<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('hari') is-invalid @enderror" name="hari" id="hari" placeholder="Hari" value="{{ $schedule->hari }}" required="required" />
                                    @error('hari')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="jam_mulai">Jam<span class="required">*</span></label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="text" name="jam_mulai" id="jam_mulai" required="required" />
                                </div>
                                <label class="col-form-label label-align" for="jam_selesai">s/d</label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="text" name="jam_selesai" id="jam_selesai" required="required" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="dosen">Dosen<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('dosen') is-invalid @enderror" name="dosen" id="dosen" required="required">
                                        <option value="">++ Pilih Dosen ++</option>
                                        @foreach($lecturer as $last_row)
                                            <option value="{{ $last_row->id }}" {{ (isset($schedule->dosen_id) && $schedule->dosen_id === $last_row->id) ? 'selected' : '' }}>{{ $last_row->nama_dosen }}</option>
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
                                        <button type='reset' class="btn btn-secondary btn-sm" id="cancel">Cancel</button>
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
<script src="{{ asset('assets/vendors/timepicker/dist/wickedpicker.min.js') }}"></script>

<!-- Javascript functions	-->
<script>
    $(document).ready(function() {
        let id = '{{ $schedule->id }}'
        let jurusanID = '{{ $schedule->jurusan_id }}';
        let prodi = '{{ $schedule->prodi_id }}';

        let jamMulai = '{{ $schedule->jam_mulai }}';
        let jamSelesai = '{{ $schedule->jam_selesai }}';

        $('#cancel').on('click', function() {
            window.location = `${SITEURL}/jadwal/jadwal-show/${id}/jurusan/${jurusanID}/prodi/${prodi}`;
        });
        $('#mata_kuliah').select2({
            width: '100%'
        });
        $('#kelas').select2({
            width: '100%'
        });
        $('#dosen').select2({
            width: '100%'
        });

        $('#jam_mulai').wickedpicker({twentyFour: true, now: jamMulai});
        $('#jam_selesai').wickedpicker({twentyFour: true, now: jamSelesai});
    });
</script>
@endsection