<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('staff.home') }}"><i class="fa fa-home"></i> Home </a></li>
            <li class="{{ (request()->is('staff/jadwal*')) ? 'active' : '' }}"><a><i class="fa fa-bank"></i> Manajemen Kampus <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="{{ (request()->is('staff/jadwal*')) ? 'display: block;' : '' }}">
                    <li class="{{ (request()->is('staff/jadwal*')) ? 'current-page' : '' }}"><a href="{{  route('schedules.index') }}">Manajemen Jadwal Kuliah</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('staff/dosen*') || request()->is('staff/mahasiswa*')) ? 'active' : '' }}"><a><i class="fa fa-send"></i> Manajemen Civitas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="{{ (request()->is('staff/dosen*') || request()->is('staff/mahasiswa*')) ? 'display: block;' : '' }}">
                    <li class="{{ (request()->is('staff/dosen*')) ? 'current-page' : '' }}"><a href="{{ route('lecturer.index') }}">Manajemen Dosen</a></li>
                    <li class="{{ (request()->is('staff/mahasiswa*')) ? 'current-page' : '' }}"><a href="{{  route('students.index') }}">Manajemen Mahasiswa</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('staff/nilai*')) ? 'active' : '' }}"><a href="{{  route('score.index') }}"><i class="fa fa-graduation-cap"></i> Manajemen Nilai </a></li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
