<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', 'Auth\LoginController@index');

Route::prefix('admin')->group(function () {
    // HOME ADMIN
    Route::get('/home', 'Admin\HomeController@index')->name('admin.home');

    // MANAGEMENT USERS
    Route::get('user/users-list', 'Admin\UsersController@index')->name('users.index');
    Route::get('user/user-add-new', 'Admin\UsersController@create')->name('users.create');
    Route::post('user/user-save-new', 'Admin\UsersController@store')->name('users.store');
    Route::get('user/user-detail/{id}', 'Admin\UsersController@show')->name('users.show');
    Route::get('user/user-edit/{id}', 'Admin\UsersController@edit');
    Route::patch('user/user-change/{id}', 'Admin\UsersController@update')->name('users.update');
    Route::delete('user/user-delete/{id}', 'Admin\UsersController@destroy')->name('users.destroy');

    // MANAGEMENT PROGRAM STUDI
    Route::get('prodi/prodi-list', 'Admin\ProdiController@index')->name('prodi.index');
    Route::get('prodi/prodi-add-new', 'Admin\ProdiController@create');
    Route::post('prodi/prodi-save-new', 'Admin\ProdiController@store')->name('prodi.store');
    Route::get('prodi/prodi-detail/{id}', 'Admin\ProdiController@show')->name('prodi.show');
    Route::get('prodi/prodi-edit/{id}', 'Admin\ProdiController@edit');
    Route::patch('prodi/prodi-change/{id}', 'Admin\ProdiController@update')->name('prodi.update');
    Route::delete('prodi/prodi-delete/{id}', 'Admin\ProdiController@destroy')->name('prodi.destroy');

    // MANAGEMENT JURUSAN
    Route::get('major/major-list', 'Admin\MajorController@index')->name('majors.index');
    Route::get('major/major-add-new', 'Admin\MajorController@create');
    Route::post('major/major-save-new', 'Admin\MajorController@store')->name('majors.store');
    Route::get('major/major-detail/{id}', 'Admin\MajorController@show')->name('majors.show');
    Route::get('major/major-edit/{id}', 'Admin\MajorController@edit');
    Route::patch('major/major-change/{id}', 'Admin\MajorController@update')->name('majors.update');
    Route::delete('major/major-delete/{id}', 'Admin\MajorController@destroy')->name('majors.destroy');

    // MANAGEMENT MATA KULIAH
    Route::get('makul/makul-list', 'Admin\MakulController@index')->name('makul.index');
    Route::get('makul/makul-add-new', 'Admin\MakulController@create');
    Route::post('makul/makul-save-new', 'Admin\MakulController@store')->name('makul.store');
    Route::get('makul/makul-detail/{id}', 'Admin\MakulController@show')->name('makul.show');
    Route::get('makul/makul-edit/{id}', 'Admin\MakulController@edit');
    Route::patch('makul/makul-change/{id}', 'Admin\MakulController@update')->name('makul.update');
    Route::delete('makul/makul-delete/{id}', 'Admin\MakulController@destroy')->name('makul.destroy');

    // MANAGEMENT KELAS
    Route::get('kelas/kelas-list', 'Admin\ClasseController@index')->name('classe.index');
    Route::get('kelas/kelas-add-new', 'Admin\ClasseController@create');
    Route::post('kelas/kelas-save-new', 'Admin\ClasseController@store')->name('classe.store');
    Route::get('kelas/kelas-detail/{id}', 'Admin\ClasseController@show')->name('classe.show');
    Route::get('kelas/kelas-edit/{id}', 'Admin\ClasseController@edit');
    Route::patch('kelas/kelas-change/{id}', 'Admin\ClasseController@update')->name('classe.update');
    Route::delete('kelas/kelas-delete/{id}', 'Admin\ClasseController@destroy')->name('classe.destroy');

    // LAPORAN DOSEN
    Route::get('lecturers/report-all', 'Admin\LecturerController@index')->name('lecturers.index');
    Route::get('lecturers/excel', 'Admin\LecturerController@export')->name('lecturers.export');

    // LAPORAN MAHASISWA
    Route::get('student/report-all', 'Admin\StudentController@index')->name('student.index');
    Route::get('student/student-kelas/{jurusan_id}', 'Admin\StudentController@ajaxKelasMhs');
    Route::get('student/excel', 'Admin\StudentController@export')->name('student.export');
});

Route::prefix('staff')->group(function () {
    // HOME STAFF
    Route::get('/home', 'Staff\HomeController@index')->name('staff.home');

    // MANAGEMENT DOSEN
    Route::get('dosen/dosen-list', 'Staff\LecturerController@index')->name('lecturer.index');
    Route::get('dosen/dosen-add-new', 'Staff\LecturerController@create');
    Route::post('dosen/dosen-save-new', 'Staff\LecturerController@store')->name('lecturer.store');
    Route::get('dosen/dosen-detail/{id}', 'Staff\LecturerController@show')->name('lecturer.show');
    Route::get('dosen/dosen-edit/{id}', 'Staff\LecturerController@edit');
    Route::patch('dosen/dosen-change/{id}', 'Staff\LecturerController@update')->name('lecturer.update');
    Route::delete('dosen/dosen-delete/{id}', 'Staff\LecturerController@destroy')->name('lecturer.destroy');

    // MANAGEMENT JADWAL KULIAH
    Route::get('jadwal/jadwal-list', 'Staff\JadwalKuliahController@index')->name('schedules.index');
    Route::get('jadwal/jadwal-detail/{id}/prodi/{prodi_id}', ['as' => 'detail', 'uses' => 'Staff\JadwalKuliahController@show']);
    Route::get('jadwal/jadwal-add-new/{id}/prodi/{prodi_id}', ['as' => 'add', 'uses' => 'Staff\JadwalKuliahController@create']);
    Route::post('jadwal/jadwal-save-new/{id}/prodi/{prodi_id}', ['as' => 'save', 'uses' => 'Staff\JadwalKuliahController@store']);
    Route::get('jadwal/jadwal-show/{id}/jurusan/{jurursan_id}/prodi/{prodi_id}', ['as' => 'show', 'uses' => 'Staff\JadwalKuliahController@detailJadwalKuliah']);
    Route::get('jadwal/jadwal-edit/{id}/jurusan/{jurursan_id}/prodi/{prodi_id}', ['as' => 'edit', 'uses' => 'Staff\JadwalKuliahController@edit']);
    Route::patch('jadwal/jadwal-change/{id}/jurusan/{jurursan_id}/prodi/{prodi_id}', ['as' => 'change', 'uses' => 'Staff\JadwalKuliahController@update']);
    Route::delete('jadwal/jadwal-delete/{id}/jurusan/{jurusan}/prodi/{prodi_id}', ['as' => 'delete', 'uses' => 'Staff\JadwalKuliahController@destroy']);

    // MANAGEMENT MAHASISWA
    Route::get('mahasiswa/mahasiswa-list', 'Staff\StudentController@index')->name('students.index');
    Route::get('mahasiswa/mahasiswa-kelas/{jurusan_id}', 'Staff\StudentController@ajaxKelas');
    Route::get('mahasiswa/mahasiswa-show-list/{jurusan_id}/kelas/{id}', 'Staff\StudentController@ajaxShow');
    Route::get('mahasiswa/mahasiswa-add-new', 'Staff\StudentController@create');
    Route::post('mahasiswa/mahasiswa-save-new', 'Staff\StudentController@store')->name('students.store');
    Route::get('mahasiswa/mahasiswa-detail/{id}', 'Staff\StudentController@show')->name('students.show');
    Route::get('mahasiswa/mahasiswa-edit/{id}', 'Staff\StudentController@edit');
    Route::patch('mahasiswa/mahasiswa-change/{id}', 'Staff\StudentController@update')->name('students.update');
    Route::delete('mahasiswa/mahasiswa-delete/{id}', 'Staff\StudentController@destroy')->name('students.destroy');

    // UPLOAD MAHASISWA
    // Route::get('mahasiswa/mahasiswa-add-new-upload', 'Staff\StudentController@uploadView');
    Route::post('mahasiswa/mahasiswa-import', 'Staff\StudentController@import')->name('students.import');
    Route::get('mahasiswa/mahasiswa-check-before-upload', 'Staff\StudentController@checkUpload');
    Route::get('mahasiswa/mahasiswa-upload-list-sukses', 'Staff\StudentController@suksesUpload');
    Route::get('mahasiswa/mahasiswa-upload-list-gagal', 'Staff\StudentController@gagalUpload');
    Route::post('mahasiswa/mahasiswa-save-to-master', 'Staff\StudentController@saveToMaster')->name('students.tomaster');
    Route::delete('mahasiswa/mahasiswa-upload-delete', 'Staff\StudentController@deleteUpload')->name('students.delup');

    // MANAGEMENT NILAI
    Route::get('nilai/mahasiswa-nilai', 'Staff\ScoreController@index')->name('score.index');
    Route::get('nilai/mahasiswa-list-data', 'Staff\ScoreController@listShow')->name('score.listshow');
    Route::get('nilai/mahasiswa-save-nilai', 'Staff\ScoreController@store')->name('score.store');
    // Route::patch('mahasiswa/mahasiswa-change/{id}/nim/{nim}', ['as' => 'changescore', 'uses' => 'Staff\ScoreController@update']);
    Route::get('nilai/mahasiswa-change-nilai', 'Staff\ScoreController@update')->name('score.update');
    Route::delete('nilai/mahasiswa-delete/{id}/nim/{nim}', ['as' => 'deletescore', 'uses' => 'Staff\ScoreController@destroy']);
    Route::post('nilai/mahasiswa-export-pdf', 'Staff\ScoreController@exportPDF')->name('score.exportpdf');
    Route::get('nilai/mahasiswa-export-excel', 'Staff\ScoreController@exportExcel')->name('score.exportexcel');
});
