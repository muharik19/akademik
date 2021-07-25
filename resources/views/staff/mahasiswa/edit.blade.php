@extends('layouts.app')
@section('title', 'Edit Mahasisa (Manual)')
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
                        <h2>Form Edit Mahasiswa</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        {{ Form::open(array('route' => array('students.update', $mhsedit->id), 'method' => 'patch', 'files' => true)) }}
                            @csrf
                            <span class="section">Personal Mahasiswa</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nim">NIM<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('nim') is-invalid @enderror" type="number" class='number' data-validate-length-range="8,20" name="nim" id="nim" placeholder="NIM" value="{{ $mhsedit->nim }}" required="required" readonly />
                                    @error('nim')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nim_change">Ubah NIM</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="number" class='number' data-validate-length-range="8,20" name="nim_change" id="nim_change" placeholder="Ubah NIM" />
                                    <small style="color: red;">* Jika nim tidak diubah kosongkan saja</small>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_mahasiswa">Nama Mahasiswa<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('nama_mahasiswa') is-invalid @enderror" data-validate-length-range="6" data-validate-words="2" name="nama_mahasiswa" id="nama_mahasiswa" placeholder="ex. John f. Kennedy" value="{{ $mhsedit->nama_mahasiswa }}" required="required" />
                                    @error('nama_mahasiswa')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="alamat">Alamat</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="alamat" id="alamat" placeholder="Alamat" type="text" value="{{ $mhsedit->alamat }}" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="telp">Telepon</label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="tel" class='tel' name="telp" id="telp" placeholder="Telepon" data-validate-length-range="8,20" value="{{ $mhsedit->telp }}" />
                                </div>
                                <label class="col-form-label label-align" for="phone">Hp</label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="tel" class='tel' name="phone" id="phone" placeholder="Hp" data-validate-length-range="8,20" value="{{ $mhsedit->hp }}" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tempat">Tempat, Tanggal Lahir</label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="text" name="tempat" id="tempat" placeholder="Tempat" value="{{ $mhsedit->tempat_lahir }}" />
                                </div>
                                <label class="col-form-label label-align" for="tanggal_lahir"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" class='date' type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ $mhsedit->tanggal_lahir }}" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="agama">Agama<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('agama') is-invalid @enderror" name="agama" id="agama" required="required">
                                        <option value="">++ Pilih Agama ++</option>
                                        <option value="Islam" {{ (isset($mhsedit->agama) && $mhsedit->agama === 'Islam') ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ (isset($mhsedit->agama) && $mhsedit->agama === 'Kristen') ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ (isset($mhsedit->agama) && $mhsedit->agama === 'Katolik') ? 'selected' : '' }}>Katolik</option>
                                        <option value="Budha" {{ (isset($mhsedit->agama) && $mhsedit->agama === 'Budha') ? 'selected' : '' }}>Budha</option>
                                        <option value="Hindu" {{ (isset($mhsedit->agama) && $mhsedit->agama === 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                    </select>
                                    @error('agama')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="prodi">Program Studi<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('prodi') is-invalid @enderror" name="prodi" id="prodi" required="required">
                                        <option value="">++ Pilih Program Studi ++</option>
                                        @foreach($programstudi as $last_row)
                                            <option value="{{ $last_row->id }}" {{ (isset($mhsedit->prodi_id) && $mhsedit->prodi_id === $last_row->id) ? 'selected' : '' }}>{{ $last_row->nama_prodi }}</option>
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
                                            <option value="{{ $rows->id }}" {{ (isset($mhsedit->jurusan_id) && $mhsedit->jurusan_id === $rows->id) ? 'selected' : '' }}>{{ $rows->nama_jurusan }}</option>
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
                                            <option value="{{ $class_row->id }}" {{ (isset($mhsedit->kelas_id) && $mhsedit->kelas_id === $class_row->id) ? 'selected' : '' }}>{{ $class_row->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelas')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kategori_kelas">Kategori Jadwal<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('kategori_kelas') is-invalid @enderror" name="kategori_kelas" id="kategori_kelas" required="required">
                                        <option value="">++ Pilih Kategori Jadwal ++</option>
                                        <option value="REG" {{ (isset($mhsedit->kategori_kelas) && $mhsedit->kategori_kelas === 'REG') ? 'selected' : '' }}>Regular</option>
						                <option value="EXE" {{ (isset($mhsedit->kategori_kelas) && $mhsedit->kategori_kelas === 'EXE') ? 'selected' : '' }}>Eksekutif/Karyawan</option>
                                    </select>
                                    @error('kategori_kelas')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" class='email' id="email" required="required" value="{{ $mhsedit->email }}" placeholder="Email" type="email" />
                                    @error('email')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="radio">&nbsp;&nbsp;
                                        <label for="l"><input type="radio" name="jk" id="l" value="L" required="required" {{ (isset($mhsedit->jk) && $mhsedit->jk === 'L') ? 'checked' : '' }} width="50"> Laki-laki</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="p"><input type="radio" name="jk" id="p" value="P" required="required" {{ (isset($mhsedit->jk) && $mhsedit->jk === 'P') ? 'checked' : '' }} width="50"> Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Aktif<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="radio">&nbsp;&nbsp;
                                        <label for="yes"><input type="radio" name="aktif" value="Y" id="yes" required="required" width="50" {{ (isset($mhsedit->aktif) && $mhsedit->aktif === 'Y') ? 'checked' : '' }}> Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="no"><input type="radio" name="aktif" value="N" id="no" required="required" width="50" {{ (isset($mhsedit->aktif) && $mhsedit->aktif === 'N') ? 'checked' : '' }}> No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="foto">Foto</label>
                                <div class="col-md-6 col-sm-6">
                                    <img id="viewImage" src="data:image/png;base64, {{ $mhsedit->foto }}" width="300px" height="250px" alt="" />
                                    <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto" id="foto" placeholder="Foto" accept="image/*" />
                                    <small style="color: red;">* Jika gambar tidak diubah kosongkan saja</small>
                                    @error('foto')
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
    function readUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#viewImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

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

    // initialize a validator instance from the "FormValidator" constructor.
    // A "<form>" element is optionally passed as an argument, but is not a must
    var validator = new FormValidator({
        "events": ['blur', 'input', 'change']
    }, document.forms[0]);
    // on form "submit" event
    document.forms[0].onsubmit = function(e) {
        var submit = true,
        validatorResult = validator.checkAll(this);
        console.log(validatorResult);
        return !!validatorResult.valid;
    };
    // on form "reset" event
    document.forms[0].onreset = function(e) {
        validator.reset();
    };
    // stuff related ONLY for this demo page:
    $('.toggleValidationTooltips').change(function() {
        validator.settings.alerts = !this.checked;
        if (this.checked)
            $('form .alert').remove();
    }).prop('checked', false);

    $(document).ready(function() {
        let id = '{{ $mhsedit->id }}';
        $('#cancel').on('click', function() {
            window.location = `${SITEURL}/mahasiswa/mahasiswa-detail/${id}`;
        });
        $("#telp").ForceNumericOnly();
        $("#phone").ForceNumericOnly();
        $('#agama').select2({
            width: '100%'
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

        $("#foto").on('change', function() {
            $('#viewImage').show();
            readUrl(this);
        });
    });
</script>
@endsection