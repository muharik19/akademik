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
                    <form action="{{ route('score.listshow') }}" method="GET" autocomplete="off">
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
</div>
<!-- /page content -->
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
        $("#nim").ForceNumericOnly();
    });
</script>
@endsection