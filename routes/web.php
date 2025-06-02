<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use \App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// JAVNO DOSTUPNE RUTE (guest i svi ostali)
Route::get('/', fn() => view('welcome'));
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('colors', ColorController::class);

Route::resource('products', ProductController::class);

Route::resource('categories', CategoryController::class);

Route::resource('colors', ColorController::class);
// LOGIN/LOGOUT
Route::get('/login', fn() => view('auth.login'))->name('login.form');
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
    return back()->with('error', 'Neispravni podaci.');
})->name('login');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); // ili ->route('dashboard') ako želiš
})->name('logout');

// DASHBOARD
Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

// TESTNO LOGIRANJE KAO ODREĐENI KORISNIK
    Route::get('/login-as/{email}', function ($email) {
        $user = User::where('email', $email)->first();
        if (!$user) return "Korisnik nije pronađen.";
        Auth::login($user);
        return "Ulogiran kao " . $user->name . " (rola: " . $user->role . ")";
    });


// SVE RUTE ISPOD OVE LINIJE ZA AUTENTIFICIRANE KORISNIKE
    Route::middleware(['auth'])->group(function () {

        // PRODUCTS CRUD
        Route::get('/products/create', [ProductController::class, 'create'])
            ->middleware('role:product.create')
            ->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])
            ->middleware('role:product.create')
            ->name('products.store');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->middleware('role:product.update')
            ->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->middleware('role:product.update')
            ->name('products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->middleware('role:product.delete')
            ->name('products.destroy');

        // COLORS CRUD
        Route::get('/colors', [ColorController::class, 'index'])
            ->middleware('role:color.read')
            ->name('colors.index');

        Route::get('/colors/create', [ColorController::class, 'create'])
            ->middleware('role:color.create')
            ->name('colors.create');
        Route::post('/colors', [ColorController::class, 'store'])
            ->middleware('role:color.create')
            ->name('colors.store');

        Route::get('/colors/{color}/edit', [ColorController::class, 'edit'])
            ->middleware('role:color.update')
            ->name('colors.edit');
        Route::put('/colors/{color}', [ColorController::class, 'update'])
            ->middleware('role:color.update')
            ->name('colors.update');

        Route::delete('/colors/{color}', [ColorController::class, 'destroy'])
            ->middleware('role:color.delete')
            ->name('colors.destroy');



    });
