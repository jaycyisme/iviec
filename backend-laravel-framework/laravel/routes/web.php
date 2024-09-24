<?php

use Illuminate\Support\Facades\Route;
// -- Fortify
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Laravel\Fortify\RoutePath;
// -- Jetstream
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;
use Laravel\Jetstream\Jetstream;
// -- Của mình
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;



Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});


// -- Jetstream
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Quyền
    Route::group(['middleware' => ['can:permission-list']], function () {
        Route::get('/quan-tri-he-thong/quyen.html', [PermissionsController::class, 'index'])->name('permissions.index');
    });
    Route::group(['middleware' => ['can:permission-create']], function () {
        Route::get('/quan-tri-he-thong/quyen/tao.html', [PermissionsController::class, 'create'])->name('permissions.create');
        Route::post('/quan-tri-he-thong/quyen/tao.html', [PermissionsController::class, 'store']);
    });
    Route::group(['middleware' => ['can:permission-edit']], function () {
        Route::get('/quan-tri-he-thong/quyen/chinh-sua-{permission}.html', [PermissionsController::class, 'edit'])->name('permissions.edit');
        Route::post('/quan-tri-he-thong/quyen/chinh-sua-{permission}.html', [PermissionsController::class, 'update']);
    });
    Route::group(['middleware' => ['can:permission-delete']], function () {
        Route::post('/quan-tri-he-thong/quyen/xoa-{permission}.html', [PermissionsController::class, 'destroy'])->name('permissions.destroy');
    });

    // Vai trò
    Route::group(['middleware' => ['can:role-list']], function () {
        Route::get('/quan-tri-he-thong/vai-tro.html', [RolesController::class, 'index'])->name('roles.index');
        Route::get('/quan-tri-he-thong/vai-tro/xem-{role}.html', [RolesController::class, 'show'])->name('roles.show');
    });
    Route::group(['middleware' => ['can:role-create']], function () {
        Route::get('/quan-tri-he-thong/vai-tro/tao.html', [RolesController::class, 'create'])->name('roles.create');
        Route::post('/quan-tri-he-thong/vai-tro/tao.html', [RolesController::class, 'store']);
    });
    Route::group(['middleware' => ['can:role-edit']], function () {
        Route::get('/quan-tri-he-thong/vai-tro/chinh-sua-{role}.html', [RolesController::class, 'edit'])->name('roles.edit');
        Route::post('/quan-tri-he-thong/vai-tro/chinh-sua-{role}.html', [RolesController::class, 'update']);
    });
    Route::group(['middleware' => ['can:role-delete']], function () {
        Route::post('/quan-tri-he-thong/vai-tro/xoa-{role}.html', [RolesController::class, 'destroy'])->name('roles.destroy');
    });

    //Tài khoản
    Route::group(['middleware' => ['can:users-list']], function () {
        Route::get('/quan-tri-he-thong/nguoi-dung.html', [UsersController::class, 'index'])->name('users.index');
        Route::get('/quan-tri-he-thong/nguoi-dung/xem-{user}.html', [UsersController::class, 'show'])->name('users.show');
    });
    Route::group(['middleware' => ['can:users-edit']], function () {
        Route::get('/quan-tri-he-thong/nguoi-dung/chinh-sua-{user}.html', [UsersController::class, 'edit'])->name('users.edit');
        Route::post('/quan-tri-he-thong/nguoi-dung/chinh-sua-{user}.html', [UsersController::class, 'update']);
    });
    Route::group(['middleware' => ['can:users-delete']], function () {
        Route::post('/quan-tri-he-thong/nguoi-dung/xoa-{user}.html', [UsersController::class, 'destroy'])->name('users.destroy');
    });
});

Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
        Route::get('/dieu-khoan-dich-vu.html', [TermsOfServiceController::class, 'show'])->name('terms.show');
        Route::get('/chinh-sach-bao-mat.html', [PrivacyPolicyController::class, 'show'])->name('policy.show');
    }

    $authMiddleware = config('jetstream.guard') ? 'auth:'.config('jetstream.guard') : 'auth';
    $authSessionMiddleware = config('jetstream.auth_session', false) ? config('jetstream.auth_session') : null;

    Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
        // User & Profile...
        Route::get('/ho-so-ca-nhan/thong-tin.html', [UserProfileController::class, 'show'])->name('profile.show');

        Route::group(['middleware' => 'verified'], function () {
            // API...
            if (Jetstream::hasApiFeatures()) {
                Route::get('/ho-so-ca-nhan/api.html', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            }

            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get('/nhom/tao.html', [TeamController::class, 'create'])->name('teams.create');
                Route::get('/nhom/{team}.html', [TeamController::class, 'show'])->name('teams.show');
                Route::put('/nhom/thong-tin.html', [CurrentTeamController::class, 'update'])->name('current-team.update');
                Route::get('/nhom/loi-moi-{invitation}.html', [TeamInvitationController::class, 'accept'])->middleware(['signed'])->name('team-invitations.accept');
            }
        });
    });
});

// -- Fortify
Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
    $enableViews = config('fortify.views', true);
    $limiter = config('fortify.limiters.login');
    $twoFactorLimiter = config('fortify.limiters.two-factor');
    $verificationLimiter = config('fortify.limiters.verification', '6,1');

    if ($enableViews) {
        Route::get(RoutePath::for('login', '/dang-nhap.html'), [AuthenticatedSessionController::class, 'create'])->middleware(['guest:'.config('fortify.guard')])->name('login');
    }

    Route::post(RoutePath::for('login', '/dang-nhap.html'), [AuthenticatedSessionController::class, 'store'])->middleware(array_filter([
        'guest:'.config('fortify.guard'),
        $limiter ? 'throttle:'.$limiter : null,
    ]));

    Route::post(RoutePath::for('logout', '/dang-xuat.html'), [AuthenticatedSessionController::class, 'destroy'])->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])->name('logout');

    if (Features::enabled(Features::resetPasswords())) {
        if ($enableViews) {
            Route::get(RoutePath::for('password.request', '/quen-mat-khau.html'), [PasswordResetLinkController::class, 'create'])->middleware(['guest:'.config('fortify.guard')])->name('password.request');
            Route::get(RoutePath::for('password.reset', '/quen-mat-khau-{token}.html'), [NewPasswordController::class, 'create'])->middleware(['guest:'.config('fortify.guard')])->name('password.reset');
        }

        Route::post(RoutePath::for('password.email', '/quen-mat-khau.html'), [PasswordResetLinkController::class, 'store'])->middleware(['guest:'.config('fortify.guard')])->name('password.email');
        Route::post(RoutePath::for('password.update', '/khoi-phuc-mat-khau.html'), [NewPasswordController::class, 'store'])->middleware(['guest:'.config('fortify.guard')])->name('password.update');
    }

    // Registration...
    if (Features::enabled(Features::registration())) {
        if ($enableViews) {
            Route::get(RoutePath::for('register', '/dang-ky.html'), [RegisteredUserController::class, 'create'])->middleware(['guest:'.config('fortify.guard')])->name('register');
        }

        Route::post(RoutePath::for('register', '/dang-ky.html'), [RegisteredUserController::class, 'store'])->middleware(['guest:'.config('fortify.guard')]);
    }

    // Email Verification...
    if (Features::enabled(Features::emailVerification())) {
        if ($enableViews) {
            Route::get(RoutePath::for('verification.notice', '/email/xac-nhan.html'), [EmailVerificationPromptController::class, '__invoke'])->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])->name('verification.notice');
        }

        Route::get(RoutePath::for('verification.verify', '/email/xac-nhan-{id}-{hash}.html'), [VerifyEmailController::class, '__invoke'])->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'signed', 'throttle:'.$verificationLimiter])->name('verification.verify');
        Route::post(RoutePath::for('verification.send', '/email/gui-email-xac-nhan.html'), [EmailVerificationNotificationController::class, 'store'])->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'throttle:'.$verificationLimiter])->name('verification.send');
    }

    // Profile Information...
    if (Features::enabled(Features::updateProfileInformation())) {
        Route::put(RoutePath::for('user-profile-information.update', '/ho-so-ca-nhan.html'), [ProfileInformationController::class, 'update'])->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])->name('user-profile-information.update');
    }

    // Passwords...
    if (Features::enabled(Features::updatePasswords())) {
        Route::put(RoutePath::for('user-password.update', '/ho-so-ca-nhan/cap-nhat-mat-khau.html'), [PasswordController::class, 'update'])->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])->name('user-password.update');
    }

    // Password Confirmation...
    if ($enableViews) {
        Route::get(RoutePath::for('password.confirm', '/ho-so-ca-nhan/xac-nhan-mat-khau.html'), [ConfirmablePasswordController::class, 'show'])
            ->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')]);
    }

    Route::get(RoutePath::for('password.confirmation', '/ho-so-ca-nhan/trang-thai-xac-nhan-mat-khau.html'), [ConfirmedPasswordStatusController::class, 'show'])->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])->name('password.confirmation');
    Route::post(RoutePath::for('password.confirm', '/ho-so-ca-nhan/trang-thai-xac-nhan-mat-khau.html'), [ConfirmablePasswordController::class, 'store'])->middleware([config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')])->name('password.confirm');

    // Two Factor Authentication...
    if (Features::enabled(Features::twoFactorAuthentication())) {
        if ($enableViews) {
            Route::get(RoutePath::for('two-factor.login', '/bao-mat-hai-lop.html'), [TwoFactorAuthenticatedSessionController::class, 'create'])->middleware(['guest:'.config('fortify.guard')])->name('two-factor.login');
        }

        Route::post(RoutePath::for('two-factor.login', '/bao-mat-hai-lop.html'), [TwoFactorAuthenticatedSessionController::class, 'store'])->middleware(array_filter([
            'guest:'.config('fortify.guard'),
            $twoFactorLimiter ? 'throttle:'.$twoFactorLimiter : null,
        ]));

        $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword') ? [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard'), 'password.confirm'] : [config('fortify.auth_middleware', 'auth').':'.config('fortify.guard')];

        Route::post(RoutePath::for('two-factor.enable', '/ho-so-ca-nhan/kich-hoat-bao-mat-hai-lop.html'), [TwoFactorAuthenticationController::class, 'store'])->middleware($twoFactorMiddleware)->name('two-factor.enable');
        Route::post(RoutePath::for('two-factor.confirm', '/ho-so-ca-nhan/xac-nhan-bao-mat-hai-lop.html'), [ConfirmedTwoFactorAuthenticationController::class, 'store'])->middleware($twoFactorMiddleware)->name('two-factor.confirm');
        Route::delete(RoutePath::for('two-factor.disable', '/ho-so-ca-nhan/tat-bao-mat-hai-lop.html'), [TwoFactorAuthenticationController::class, 'destroy'])->middleware($twoFactorMiddleware)->name('two-factor.disable');
        Route::get(RoutePath::for('two-factor.qr-code', '/ho-so-ca-nhan/qr-code-bat-mat-hai-lop.html'), [TwoFactorQrCodeController::class, 'show'])->middleware($twoFactorMiddleware)->name('two-factor.qr-code');
        Route::get(RoutePath::for('two-factor.secret-key', '/ho-so-ca-nhan/ma-khoa-bao-mat-hai-lop.html'), [TwoFactorSecretKeyController::class, 'show'])->middleware($twoFactorMiddleware)->name('two-factor.secret-key');
        Route::get(RoutePath::for('two-factor.recovery-codes', '/ho-so-ca-nhan/ma-khoi-phuc-bao-mat-hai-lop.html'), [RecoveryCodeController::class, 'index'])->middleware($twoFactorMiddleware)->name('two-factor.recovery-codes');
        Route::post(RoutePath::for('two-factor.recovery-codes', '/ho-so-ca-nhan/ma-khoi-phuc-bao-mat-hai-lop.html'), [RecoveryCodeController::class, 'store'])->middleware($twoFactorMiddleware);
    }
});
