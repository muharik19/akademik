@extends('layouts.app')
@section('title', 'Home')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><span>Home</span></h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2><span>Welcome to Administrator System</span></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            Hai <b>{{ Auth::user()->nama_lengkap }}</b>, Selamat datang di halaman utama sistem akademik kampus, Anda dapat mengolah segala aktifitas dalam sistem ini.. semua aktifitas yang Anda lakukan akan terekam dalam database.
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_content">
            Date Login: {{ $user->last_login }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection