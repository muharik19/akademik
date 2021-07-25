<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-home"></i> Home </a></li>
            <!-- https://quickadminpanel.com/blog/laravel-how-to-make-menu-item-active-by-urlroute/ -->
            <li class="{{ (request()->is('admin/user*') || request()->is('admin/prodi*') || request()->is('admin/major*') || request()->is('admin/makul*') || request()->is('admin/kelas*')) ? 'active' : '' }}"><a><i class="fa fa-bank"></i> Manajemen Kampus <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="{{ (request()->is('admin/user*') || request()->is('admin/prodi*') || request()->is('admin/major*') || request()->is('admin/makul*') || request()->is('admin/kelas*')) ? 'display: block;' : '' }}">
                    <li class="{{ (request()->is('admin/user*')) ? 'current-page' : '' }}"><a href="{{ route('users.index') }}">Manajemen User</a></li>
                    <li class="{{ (request()->is('admin/prodi*')) ? 'current-page' : '' }}"><a href="{{ route('prodi.index') }}">Manajemen Program Studi</a></li>
                    <li class="{{ (request()->is('admin/major*')) ? 'current-page' : '' }}"><a href="{{ route('majors.index') }}">Manajemen Jurusan</a></li>
                    <li class="{{ (request()->is('admin/makul*')) ? 'current-page' : '' }}"><a href="{{ route('makul.index') }}">Manajemen Mata Kuliah</a></li>
                    <li class="{{ (request()->is('admin/kelas*')) ? 'current-page' : '' }}"><a href="{{ route('classe.index') }}">Manajemen Kelas</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-folder-open"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('lecturers.index') }}">Data Dosen</a></li>
                    <li><a href="{{ route('student.index') }}">Data Mahasiswa</a></li>
                </ul>
            </li>
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
