@extends('layouts.app')
@section('title', 'Edit Dosen')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Dosen</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Edit Dosen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="{{ route('lecturer.update',$dosenedit->id) }}" method="POST" autocomplete="off" name="edit-user">
                            @method('patch')
                            @csrf
                            <span class="section">Personal Dosen</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_dosen">NIP/Kode Dosen<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('kode_dosen') is-invalid @enderror" type="number" class='number' data-validate-length-range="8,20" name="kode_dosen" id="kode_dosen" value="{{ $dosenedit->kode_dosen }}" placeholder="NIP/Kode Dosen" required="required" readonly />
                                    @error('kode_dosen')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_dosen">Nama Lengkap<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('nama_dosen') is-invalid @enderror" data-validate-length-range="6" data-validate-words="2" name="nama_dosen" id="nama_dosen" value="{{ $dosenedit->nama_dosen }}" placeholder="ex. John f. Kennedy" required="required" />
                                    @error('nama_dosen')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="alamat">Alamat</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" class='optional' name="alamat" id="alamat" placeholder="Alamat" value="{{ $dosenedit->alamat }}" data-validate-length-range="5,15" type="text" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="telp">Telepon</label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="tel" class='tel' name="telp" id="telp" placeholder="Telepon" value="{{ $dosenedit->telp }}" data-validate-length-range="8,20" />
                                </div>
                                <label class="col-form-label label-align" for="phone">Hp</label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="tel" class='tel' name="phone" id="phone" placeholder="Hp" value="{{ $dosenedit->hp }}" data-validate-length-range="8,20" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="agama">Agama<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('agama') is-invalid @enderror" name="agama" id="agama" required="required">
                                        <option value="">++ Pilih Agama ++</option>
                                        <option value="Islam" {{ (isset($dosenedit->agama) && $dosenedit->agama === 'Islam') ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ (isset($dosenedit->agama) && $dosenedit->agama === 'Kristen') ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ (isset($dosenedit->agama) && $dosenedit->agama === 'Katolik') ? 'selected' : '' }}>Katolik</option>
                                        <option value="Budha" {{ (isset($dosenedit->agama) && $dosenedit->agama === 'Budha') ? 'selected' : '' }}>Budha</option>
                                        <option value="Hindu" {{ (isset($dosenedit->agama) && $dosenedit->agama === 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                    </select>
                                    @error('agama')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" class='email' id="email" value="{{ $dosenedit->email }}" required="required" placeholder="Email" type="email" />
                                    @error('email')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Jenis Kelamin<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="radio">&nbsp;&nbsp;
                                        <label for="l"><input type="radio" name="jk" id="l" value="L" {{ (isset($dosenedit->jk) && $dosenedit->jk === 'L') ? 'checked' : '' }} required="required"  width="50"> Laki-laki</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="p"><input type="radio" name="jk" id="p" value="P" {{ (isset($dosenedit->jk) && $dosenedit->jk === 'P') ? 'checked' : '' }} required="required"  width="50"> Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Aktif<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="radio">&nbsp;&nbsp;
                                        <label for="yes"><input type="radio" name="aktif" value="Y" id="yes" {{ (isset($dosenedit->aktif) && $dosenedit->aktif === 'Y') ? 'checked' : '' }} required="required" width="50"> Yes</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="no"><input type="radio" name="aktif" value="N" id="no" {{ (isset($dosenedit->aktif) && $dosenedit->aktif === 'N') ? 'checked' : '' }} required="required" width="50"> No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="pendidikan">Pendidikan Terakhir<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" id="pendidikan" required="required">
                                        <option value="">++ Pilih Pendidikan Terakhir ++</option>
                                        @foreach($last_educations as $last_row)
                                            <option value="{{ $last_row->id }}" {{ (isset($dosenedit->pendidikanID) && $dosenedit->pendidikanID === $last_row->id) ? 'selected' : '' }}>{{ $last_row->pendidikan_terakhir }}</option>
                                        @endforeach
                                    </select>
                                    @error('pendidikan')
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
    jQuery.fn.ForceNumericOnly = function() {
        return this.each(function() {
            $(this).keydown(function(e) {
                let key = e.charCode || e.keyCode || 0;
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
    let validator = new FormValidator({
        "events": ['blur', 'input', 'change']
    }, document.forms[0]);
    // on form "submit" event
    document.forms[0].onsubmit = function(e) {
        let submit = true,
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
        let id = '{{ $dosenedit->id }}';
        $('.cancel').on('click', function() {
            window.location = `${SITEURL}/dosen/dosen-detail/${id}`;
        });
        $("#telp").ForceNumericOnly();
        $("#phone").ForceNumericOnly();
        $('#pendidikan').select2({
            width: '100%'
        });
        $('#agama').select2({
            width: '100%'
        });
    });
</script>
@endsection