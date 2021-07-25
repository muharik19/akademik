<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/ico" />
        <title>Mimalabs | @yield('title')</title>
        <!-- CDN Datatables -->
        <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <!-- Bootstrap -->
        <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="{{ asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{{ asset('assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
        <!-- starrr -->
            <link href="{{ asset('assets/vendors/starrr/dist/starrr.css') }}" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
        <!-- Datatables -->
        @yield('css')
        <!-- Sweet Alert -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Custom Theme Style -->
        <link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="javascript:void(0)" class="site_title"><i class="fa fa-paw"></i> <span>Mimalabs</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="{{ asset('assets/images/img_avatar3.png') }}" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>
                                    @if(Auth::check())
                                        {{ ucwords(Auth::user()->username) }}
                                    @endif
                                </h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />
                        <input type="hidden" value="{{ Auth::user()->level ?? '' }}" id="site_url" />
                        @if(Auth::check())
                            @if (Auth::user()->aktif === 'Y')
                                @if (Auth::user()->level === 1)
                                    @include('admin.master.admin_sidebar')
                                @elseif (Auth::user()->level === 2)
                                    @include('staff.master.staff_sidebar')
                                @endif
                            @endif
                        @endif
                        @include('sweetalert::alert')
                    </div>
                </div>

                @include('layouts.top_navigation')

                <!-- page content -->
                @yield('content')
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Copyright © 2020 Mimalabs. All rights reserved.
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
        <!-- NProgress -->
        <script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>
        <!-- Chart.js -->
        <script src="{{ asset('assets/vendors/Chart.js/dist/Chart.min.js') }}"></script>
        <!-- gauge.js -->
        <script src="{{ asset('assets/vendors/gauge.js/dist/gauge.min.js') }}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{ asset('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
        <!-- Sweet Alert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <!-- iCheck -->
        <script src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
        <!-- Datatables -->
        @yield('script')
        <!-- Skycons -->
        <script src="{{ asset('assets/vendors/skycons/skycons.js') }}"></script>
        <!-- Flot -->
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.time.js') }}"></script>
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.stack.js') }}"></script>
        <script src="{{ asset('assets/vendors/Flot/jquery.flot.resize.js') }}"></script>
        <!-- Flot plugins -->
        <script src="{{ asset('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/flot.curvedlines/curvedLines.js') }}"></script>
        <!-- DateJS -->
        <script src="{{ asset('assets/vendors/DateJS/build/date.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('assets/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
        <script src="{{ asset('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{ asset('assets/vendors/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <!-- jQuery Tags Input -->
        <script src="{{ asset('assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
        <!-- Switchery -->
        <script src="{{ asset('assets/vendors/switchery/dist/switchery.min.js') }}"></script>
        <!-- Autosize -->
        <script src="{{ asset('assets/vendors/autosize/dist/autosize.min.js') }}"></script>
        <!-- jQuery autocomplete -->
        <script src="{{ asset('assets/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
        <!-- starrr -->
        <script src="{{ asset('assets/vendors/starrr/dist/starrr.js') }}"></script>
        <!-- loadingoverlay -->
        <script src="{{ asset('assets/global/scripts/loadingoverlay.min.js') }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset('assets/build/js/custom.min.js') }}"></script>
        <script>
            let levelID = document.getElementById("site_url").value;
            if (levelID === '1') {
                window.SITEURL = '{{URL::to('/admin/')}}';
            } else if (levelID === '2') {
                window.SITEURL = '{{URL::to('/staff/')}}';
            }
            window.showLoading = function() {
				$.LoadingOverlay("show", {
					imageColor: '#0000ff'
				});
			}
			window.hideLoading = function() {
				$.LoadingOverlay("hide", {
					imageColor: '#0000ff'
				});
			}
            $(document).ajaxStart(function(){
				showLoading()
			})
			$(document).ajaxSuccess(function(){
				hideLoading()
			})
        </script>
    </body>
</html>
