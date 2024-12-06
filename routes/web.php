<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AutoFillController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidIdController;
use App\Http\Controllers\VehiclePremiumController;
use Illuminate\Support\Facades\Route;

Route::delete('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login_view'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/qr_verifier', function () {
        return view('qr_verifier');
    });
    Route::get('/verify_qr/{coc_no}', [AuthenticationController::class, 'verify_qr']);
});

Route::middleware('auth')->group(function () {
    Route::prefix('autofill')->group(function () {
        Route::controller(AutoFillController::class)->group(function () {
            Route::get('/policy_holder/{id_number}', 'policy_holder');
        });
    });

    Route::prefix('tools')->group(function () {
        Route::controller(ToolController::class)->group(function () {
            Route::get('/raw_data', 'raw_data');
            Route::get('/data_import', 'data_import');
            Route::post('/process_import/{target}', 'process_import');
        });
    });

    Route::prefix('search')->group(function () {
        Route::controller(SearchController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/policy_holders', 'policy_holders');
            Route::get('/insured_vehicles', 'insured_vehicles');
            Route::get('/authenticated_policies', 'authenticated_policies');
        });
    });

    Route::prefix('dashboard')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index');
        });

        Route::prefix('announcement')->group(function () {
            Route::controller(AnnouncementController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/create', 'create');
                Route::post('/', 'store');
                Route::get('/{id}/edit', 'edit');
                Route::patch('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });
    });

    Route::prefix('setting')->group(function () {
        Route::prefix('vehicle_premium')->group(function () {
            Route::controller(VehiclePremiumController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/create', 'create');
                Route::post('/', 'store');
                Route::get('/{id}/edit', 'edit');
                Route::patch('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });

        Route::prefix('valid_id')->group(function () {
            Route::controller(ValidIdController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/create', 'create');
                Route::post('/', 'store');
                Route::get('/{id}/edit', 'edit');
                Route::patch('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });
    });

    Route::prefix('company')->group(function () {
        Route::controller(CompanyController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('user')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('authentication')->group(function () {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}/print', 'print');
            Route::get('/{id}/preview', 'preview');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

        Route::controller(AuthenticatedController::class)->group(function () {
            Route::get('/policy/{id}', 'policy');
        });
    });
});
