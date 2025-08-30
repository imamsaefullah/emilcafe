<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\{
    Payments,
    DashboardController,
    Profile,
    CasirController,
    TransactionController,
    GoodController,
    KitchenController,
    Superadmin,
    ReportController
};

// ===== PUBLIC =====
Route::view('/', 'homepage.welcome');
//order Routing
Route::get('order', [DashboardController::class, 'order'])->name('order');
//payment proses
Route::prefix('payments')->name('payments.')->group(function () {
    Route::get('/', [Payments::class, 'index'])->name('index');
    Route::post('/store', [Payments::class, 'store'])->name('store');
    Route::post('/snap/token', [Payments::class, 'getSnapToken'])->name('getSnapToken');
});
// Checkout QRIS
Route::view('/qris', 'homepage.checkout.qris')->name('checkout.qris');

// ===== AUTH =====
Route::controller(Profile::class)->group(function () {
    //login
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginProcess')->name('login.proses');
    // sign up
    Route::get('signup', 'signup')->name('profile.signup');
    Route::post('signup', 'signupUser')->name('profile.signupUser');
    // logout
    Route::post('logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    })->name('logout')->middleware('auth');
});

// ===== FITUR UNTUK ADMIN & SUPERADMIN =====
Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {

    Route::controller(Profile::class)->group(function () {
        Route::get('profile', 'index')->name('profile');
        // Edit user
        Route::get('/user/{id}/edit', [Superadmin::class, 'edit'])->name('profile.edit');

        // Update user
        Route::put('/user/{id}', [Superadmin::class, 'update'])->name('profile.update');

        // Hapus user
        Route::delete('/user/{id}', [Superadmin::class, 'destroy'])->name('user.destroy');
    });
    // Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/nota/{id}', [DashboardController::class, 'cetakNota'])->name('nota.cetak');
        Route::get('/nota/download/{id}', [DashboardController::class, 'notaDownload'])->name('nota.download');
    });

    // Resource Controllers
    Route::resources([
        'casir' => CasirController::class,
        'transactions' => TransactionController::class,
        'goods' => GoodController::class,
    ]);

    // Kitchen
    Route::prefix('kitchen')->name('kitchen.')->group(function () {
        Route::get('/', [KitchenController::class, 'index'])->name('home'); // /kitchen
        Route::get('/{id}', [KitchenController::class, 'show'])->name('show'); // /kitchen/{id}
        Route::post('/{id}/update-status', [KitchenController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/{id}/download-pdf', [KitchenController::class, 'downloadPdf'])->name('downloadPdf');
        Route::get('/data', [KitchenController::class, 'data'])->name('data'); // ✅ FIX
        Route::delete('/kitchen/{id}/delete', [KitchenController::class, 'destroy'])->name('kitchen.destroy');
    });
});

// ===== HANYA SUPERADMIN =====
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/alluser', [Superadmin::class, 'index'])->name('superadmin');
    Route::get('/report', [ReportController::class,'index'])->name('report');
});
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', [Superadmin::class, 'staff'])->name('onlystaff');
});
