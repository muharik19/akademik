@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Management Users</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Edit User</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="{{ route('users.update',$user->id) }}" method="POST" autocomplete="off" name="edit-user">
                            @method('patch')
                            @csrf
                            <span class="section">Personal User</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nip">NIP<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('nip') is-invalid @enderror" type="number" class='number' data-validate-length-range="8,20" name="nip" id="nip" value="{{ $user->nip }}" placeholder="NIP" required="required" readonly />
                                    @error('nip')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_lengkap">Nama Lengkap<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('nama_lengkap') is-invalid @enderror" data-validate-length-range="6" data-validate-words="2" name="nama_lengkap" id="nama_lengkap" value="{{ $user->nama_lengkap }}" placeholder="ex. John f. Kennedy" required="required" />
                                    @error('nama_lengkap')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="alamat">Alamat</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" class='optional' name="alamat" id="alamat" placeholder="Alamat" value="{{ $user->alamat }}" data-validate-length-range="5,15" type="text" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="telp">Telepon</label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="tel" class='tel' name="telp" id="telp" placeholder="Telepon" value="{{ $user->telp }}" data-validate-length-range="8,20" />
                                </div>
                                <label class="col-form-label label-align" for="phone">Hp</label>
                                <div class="col-md-2 col-sm-2">
                                    <input class="form-control" type="tel" class='tel' name="phone" id="phone" placeholder="Hp" value="{{ $user->hp }}" data-validate-length-range="8,20" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="agama">Agama<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('agama') is-invalid @enderror" name="agama" id="agama" required="required">
                                        <option value="">++ Pilih Agama ++</option>
                                        <option value="Islam" {{ (isset($user->agama) && $user->agama === 'Islam') ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ (isset($user->agama) && $user->agama === 'Kristen') ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ (isset($user->agama) && $user->agama === 'Katolik') ? 'selected' : '' }}>Katolik</option>
                                        <option value="Budha" {{ (isset($user->agama) && $user->agama === 'Budha') ? 'selected' : '' }}>Budha</option>
                                        <option value="Hindu" {{ (isset($user->agama) && $user->agama === 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                    </select>
                                    @error('agama')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" class='email' id="email" value="{{ $user->email }}" required="required" placeholder="Email" type="email" />
                                    @error('email')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Aktif<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="radio col-md-2 col-sm-2">
                                        <label for="yes"><input type="radio" name="aktif" id="yes" value="Y" {{ (isset($user->aktif) && $user->aktif === 'Y') ? 'checked' : '' }} required="required"> Yes</label>
                                    </div>
                                    <div class="radio col-md-2 col-sm-2">&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="no"><input type="radio" name="aktif" id="no" value="N" {{ (isset($user->aktif) && $user->aktif === 'N') ? 'checked' : '' }} required="required"> No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Level<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="radio">&nbsp;&nbsp;
                                        <label for="ad"><input type="radio" name="level" value="1" {{ (isset($user->level) && $user->level === 1) ? 'checked' : '' }} id="ad" required="required" width="50"> Administrator</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <label for="sf"><input type="radio" name="level" value="2" {{ (isset($user->level) && $user->level === 2) ? 'checked' : '' }} id="sf" required="required" width="50"> Staff Kampus</label>
                                    </div>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="pendidikan">Pendidikan Terakhir<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" id="pendidikan" required="required">
                                        <option value="">++ Pilih Pendidikan Terakhir ++</option>
                                        @foreach($last_educations as $last_row)
                                            <option value="{{ $last_row->id }}" {{ (isset($user->pendidikanID) && $user->pendidikanID === $last_row->id) ? 'selected' : '' }}>{{ $last_row->pendidikan_terakhir }}</option>
                                        @endforeach
                                    </select>
                                    @error('pendidikan')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ $user->username }}"  required="required" />
                                    @error('username')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="change">Change Password</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="checkbox" name="change_password" id="change" onclick="showChangePassword()">
                                </div>
                            </div>
                            <div class="field item form-group" style="display:none" id="show-change">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="password1">Password</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" id="password1" name="password" placeholder="Change Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}" title="Minimum 8 Characters Including An Upper And Lower Case Letter, A Number And A Unique Character" />
                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()" >
                                        <i id="slash" class="fa fa-eye-slash"></i>
                                        <i id="eye" class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="clearfix"></div><br />
                            <div class="field item form-group" style="display:none" id="show-repeat">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="password2">Repeat Password</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control @error('repeat_password') is-invalid @enderror" type="password" name="repeat_password" id="password2" data-validate-linked='password' placeholder="Repeat Password" />
                                    @error('repeat_password')
                                        <span class="badge badge-warning">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><br />
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
    function hideshow(){
        let password = document.getElementById("password1");
        let slash = document.getElementById("slash");
        let eye = document.getElementById("eye");
        if (password.type === 'password') {
            password.type = "text";
            slash.style.display = "block";
            eye.style.display = "none";
        } else {
            password.type = "password";
            slash.style.display = "none";
            eye.style.display = "block";
        }
    }

    function showChangePassword() {
        let checkBox = document.getElementById("change");
        let passwordChange = document.getElementById("show-change");
        let passwordRepeat = document.getElementById("show-repeat");
        if (checkBox.checked === true){
            passwordChange.style.display = "block";
            passwordRepeat.style.display = "block";
        } else {
            passwordChange.style.display = "none";
            passwordRepeat.style.display = "none";
        }
    }

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
        let id = '{{ $user->id }}';
        $('.cancel').on('click', function() {
            window.location = `${SITEURL}/user/user-detail/${id}`;
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