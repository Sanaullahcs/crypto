<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
// use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\File;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('migration-run', function () {
    try {
        Artisan::call('migrate');
        return 'Migrations have been run successfully!';
    } catch (\Exception $e) {
        return 'Error running migrations: ' . $e->getMessage();
    }
});

Route::get('mail-test', function () {
    try {
        dump(\Mail::raw('This is a simple text email.', function ($message) {
            $message->to('aqibjavaidabbasi@gmail.com')->subject('Simple Text Email');
        }));
        dd('done');
    } catch (\Exception $e) {
        dd($e);
        return 'Email Error: ' . $e->getMessage();
    }
});

// run seeder


Route::get('/run-seeder/{seeder}', function ($seeder) {
    $seederClass = ucfirst($seeder);
    $seederFile = database_path('seeders/' . $seederClass . '.php');

    if (File::exists($seederFile)) {
        Artisan::call('db:seed', ['--class' => $seederClass]);
        return 'Seeder executed: ' . $seederClass;
    } else {
        return 'Invalid seeder: ' . $seederClass;
    }
});

Route::get('/{any}', function ($any = null) {
    if (strpos($any, 'images/') === 0) {
        return response()->file(public_path($any));
    } else {
        return view('layouts.app');
    }
})->where("any", ".*");