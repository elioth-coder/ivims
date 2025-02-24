<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AutoFillController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InsuranceCompanyController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\PolicyHolderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TechSupportController;
use App\Http\Controllers\TicketCategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidIdController;
use App\Http\Controllers\VehicleBodyTypeController;
use App\Http\Controllers\VehiclePremiumController;
use App\Http\Middleware\IsPolicyHolder;
use App\Models\Company;
use App\Models\VehiclePremium;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/download/{filename}', function ($filename) {
    $path = Storage::url('uploads/' . $filename);
    if (file_exists($path)) {
        return response()->download($path);
    } else {
        abort(404); // File not found
    }
});

Route::delete('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/verify_qr/{coc_no}', [AuthenticationController::class, 'verify_qr']);
Route::get('/qr_verifier', function () {
    return view('qr_verifier');
});

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
        $ctpl_rates = VehiclePremium::all();
        $companies  = Company::latest()->limit(10)->get();

        return view('welcome', [
            'ctpl_rates' => $ctpl_rates,
            'companies'  => $companies,
        ]);
    });

    Route::prefix('insurance_companies')->group(function () {
        Route::controller(InsuranceCompanyController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/branches', 'branches');
            Route::get('/agents', 'agents');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('customer')->group(function () {
        Route::controller(CustomerController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/insurances', 'insurances');
            Route::get('/create_ticket', 'create_ticket');
            Route::post('/store_ticket', 'store_ticket');
            Route::get('/tickets', 'tickets');
            Route::get('/ticket_chat/{id}', 'ticket_chat');
            Route::post('/store_chat', 'store_chat');
        });
    });

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
                Route::get('/{id}/edit', 'edit');
                Route::patch('/{id}', 'update');
                Route::get('/{status}/status', 'status');
                Route::post('/', 'store');
                Route::delete('/{id}', 'destroy');
                Route::post('/chat', 'chat');
                Route::post('/status_update', 'status_update');
            });
        });

        Route::prefix('autofill')->group(function () {
            Route::controller(AutoFillController::class)->group(function () {
                Route::get('/policy_holder/{id_number}', 'policy_holder');
                Route::get('/vehicle_detail/{plate_no}', 'vehicle_detail');
            });
        });

        Route::prefix('license')->group(function () {
            Route::controller(LicenseController::class)->group(function () {
                Route::get('/', 'index');
                Route::get('/company', 'company');
                Route::get('/company/{id}/renew', 'company_renew');
                Route::post('/company/{id}/renewal', 'company_renewal');
                Route::get('/company/{id}/revoke', 'company_revoke');
                Route::post('/company/{id}/revokal', 'company_revokal');

                Route::get('/branch', 'branch');
                Route::get('/branch/{id}/renew', 'branch_renew');
                Route::post('/branch/{id}/renewal', 'branch_renewal');
                Route::get('/branch/{id}/revoke', 'branch_revoke');
                Route::post('/branch/{id}/revokal', 'branch_revokal');

                Route::get('/agent', 'agent');
                Route::get('/agent/{id}/renew', 'agent_renew');
                Route::post('/agent/{id}/renewal', 'agent_renewal');
                Route::get('/agent/{id}/revoke', 'agent_revoke');
                Route::post('/agent/{id}/revokal', 'agent_revokal');
            });
        });

        Route::prefix('tools')->group(function () {
            Route::controller(ToolController::class)->group(function () {
                Route::get('/', 'index');
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
                Route::get('/', 'index')->name('dashboard');
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
            Route::get('/', function () {
                return view('setting.index');
            });

            Route::prefix('ctpl_rate')->group(function () {
                Route::controller(VehiclePremiumController::class)->group(function () {
                    Route::get('/', 'index');
                    Route::get('/create', 'create');
                    Route::post('/', 'store');
                    Route::get('/{id}/edit', 'edit');
                    Route::patch('/{id}', 'update');
                    Route::delete('/{id}', 'destroy');
                });
            });

            Route::prefix('vehicle_type')->group(function () {
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

            Route::prefix('ticket_category')->group(function () {
                Route::controller(TicketCategoryController::class)->group(function () {
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
                Route::get('/{id}/renew', 'renew');
                Route::post('/{id}/renewal', 'renewal');
                Route::patch('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });

        Route::prefix('user')->group(function () {
            Route::get('/', function() {
                return view('user.index');
            });

            Route::prefix('tech_support')->group(function () {
                Route::controller(TechSupportController::class)->group(function () {
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
                    Route::get('/{id}/renew', 'renew');
                    Route::post('/{id}/renewal', 'renewal');
                    Route::patch('/{id}', 'update');
                    Route::delete('/{id}', 'destroy');
                });
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
