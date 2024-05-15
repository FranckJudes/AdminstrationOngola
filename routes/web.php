<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Brian2694\Toastr\Facades\Toastr;

Route::get('', function () {
    Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);

    return view('Dashboard.index');
});

Route::resource('dashboard','App\Http\Controllers\Dashboard\DashboardController');
Route::resource('auth','App\Http\Controllers\Auth\AuthController');
Route::resource('livreurs', 'App\Http\Controllers\Livreurs\LivreurController');
Route::resource('admin', 'App\Http\Controllers\SousAdmin\AdminController');
Route::resource('settings', 'App\Http\Controllers\Settings\SettingController');
Route::resource('partenaires', 'App\Http\Controllers\Partenaires\PartenaireController');


Route::controller(AuthController::class)->group(
    function(){
        Route::get('locale/{langue}','setLang')->name('locale');
        Route::get('logout','logout')->name('logout');

    }
);


// Settings
Route::get('/livreur_password', [App\Http\Controllers\Settings\SettingController::class, 'livreur_password'])->name('livreur_password');
Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/susprendre_livreur/{id}', [App\Http\Controllers\Livreurs\LivreurController::class, 'suspendre_livreur'])->name('suspendre_livreur');
Route::get('/activer_livreur/{id}', [App\Http\Controllers\Livreurs\LivreurController::class, 'activer_livreur'])->name('activer_livreur');

Route::post('/password', [App\Http\Controllers\Settings\PasswordController::class, 'store'])->name('password_save');
Route::get('/partenaire_associes/{id}', [App\Http\Controllers\SousAdmin\AdminController::class, 'partenaire_associes'])->name('partenaire_associes');



