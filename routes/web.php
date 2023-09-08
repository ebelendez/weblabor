<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Counter;
use App\Livewire\DashbComponent;
use App\Livewire\TinyMce;
use App\Mail\mailReporte;
use App\Models\Emails;
use Illuminate\Support\Facades\Route;

/*
Development
*/
Route::get('/mail', function () {
    return new mailReporte();
});
Route::get('xx', function()
{
    return view('xx');
});
Route::get('yy', function()
{
    return view('yy');
});

/*
Routes
*/
Route::get('/', function(){return redirect('dashboard');});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashbComponent::class)->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mail_cron', function () {
    Emails::enviarCorreo();
});

require __DIR__.'/auth.php';
