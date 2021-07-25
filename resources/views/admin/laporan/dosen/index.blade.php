@extends('layouts.app')
@section('title', 'Laporan Dosen')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Laporan Dosen</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Laporan Seluruh Data Dosen</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="{{ route('lecturers.export') }}" method="GET" autocomplete="off">
                            @csrf
                            <span class="section">Personal Laporan Dosen</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status Dosen<span class="required">*</span></label>
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
    });
</script>
@endsection