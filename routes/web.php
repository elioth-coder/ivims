<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AutoFillController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PolicyHolderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubagentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidIdController;
use App\Http\Controllers\VehicleBodyTypeController;
use App\Http\Controllers\VehiclePremiumController;
use App\Http\Middleware\IsPolicyHolder;
use Illuminate\Support\Facades\Route;

Route::delete('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/login', 'login_view')->name('login');
        Route::post('/login', 'login');
        Route::get('/register', 'register');
        Route::get('/email_activation/{token_value}', 'email_activation');
        Route::post('/email_registration', 'email_registration');
        Route::get('/check_email', 'check_email');
    });

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/qr_verifier', function () {
        return view('qr_verifier');
    });
    Route::get('/verify_qr/{coc_no}', [AuthenticationController::class, 'verify_qr']);
});

Route::middleware('auth')->group(function () {

    Route::prefix('u')->group(function () {
        Route::controller(PolicyHolderController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/insurance', 'insurance');
        });
    });

    Route::prefix('u/chat_support')->group(function () {
        Route::controller(CustomerSupportController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/create', 'create');
            Route::delete('/{id}', 'destroy');
            Route::get('/ticket/{id}', 'ticket');
            Route::post('/chat', 'chat');
        });
    });

    Route::middleware([IsPolicyHolder::class])->group(function () {
        Route::prefix('ticket')->group(function () {
            Route::controller(TicketController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/create', 'create');
                Route::get('/{id}', 'ticket');
                Route::post('/', 'store');
                Route::delete('/{id}', 'destroy');
                Route::post('/chat', 'chat');
                Route::post('/status_update', 'status_update');
            });
        });

        Route::prefix('autofill')->group(function () {
            Route::controller(AutoFillController::class)->group(function () {
                Route::get('/policy_holder/{id_number}', 'policy_holder');
                Route::get('/vehicle_detail/{mv_file_no}', 'vehicle_detail');
            });
        });

        Route::prefix('tools')->group(function () {
            Route::controller(ToolController::class)->group(function () {
                Route::get('/raw_data', 'raw_data');
                Route::get('/data_import', 'data_import');
                Route::get('/data_faker', 'data_faker');
                Route::get('/backup_restore', 'backup_restore');
                Route::get('/backup_restore/download/{file_name}', 'download');
                Route::post('/backup_restore/generate', 'generate');
                Route::post('/backup_restore/delete', 'delete');
                Route::post('/backup_restore/restore', 'restore');
                Route::post('/backup_restore/restore_from_file', 'restore_from_file');
                Route::post('/process_import/{target}', 'process_import');
                Route::post('/update_municipality', 'update_municipality');
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

            Route::prefix('report')->group(function () {
                Route::controller(ReportController::class)->group(function () {
                    Route::get('/', 'index');
                    Route::get('/upload_count_per_company', 'upload_count_per_company');
                    Route::get('/upload_count_per_month', 'upload_count_per_month');
                    Route::get('/upload_count_per_province', 'upload_count_per_province');
                });
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

            Route::prefix('vehicle_body_type')->group(function () {
                Route::controller(VehicleBodyTypeController::class)->group(function () {
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

        Route::prefix('branch')->group(function () {
            Route::controller(BranchController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/create', 'create');
                Route::post('/', 'store');
                Route::get('/{id}/edit', 'edit');
                Route::patch('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });

        Route::prefix('agent')->group(function () {
            Route::controller(AgentController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/create', 'create');
                Route::post('/', 'store');
                Route::get('/{id}/edit', 'edit');
                Route::patch('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });

        Route::prefix('subagent')->group(function () {
            Route::controller(SubagentController::class)->group(function () {
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
                Route::get('/vehicle/{id}', 'vehicle');
                Route::get('/holder/{id}', 'holder');
            });
        });
    });
});
