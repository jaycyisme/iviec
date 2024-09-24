<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobNewController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\CandidateController;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Controllers\CandidateRepositoryController;
use App\Http\Controllers\RecruitmentRequirementController;

// Yêu cầu tuyển dụng
Route::group(['middleware' => ['can:recruitment-management-list']], function () {
    Route::get('/recruitment-management/recruitment-requirements.html', [RecruitmentRequirementController::class, 'index'])->name('recruitment_requirements.index');
    Route::get('/recruitment-management/show-{id}.html', [RecruitmentRequirementController::class, 'show'])->name('recruitment_requirements.show');
});

Route::group(['middleware' => ['can:recruitment-management-create']], function () {
    // Route::post('/recruitment-management/create.html', [RecruitmentRequirementController::class, 'store'])->name('recruitment-managements.create');
});
Route::middleware([StartSession::class])->post('/recruitment-management/create.html', [RecruitmentRequirementController::class, 'store'])->name('recruitment-managements.create');

Route::group(['middleware' => ['can:recruitment-management-edit']], function () {
    Route::get('/recruitment-management/update-{id}.html', [RecruitmentRequirementController::class, 'edit'])->name('recruitment-managements.edit');
    // Route::post('/recruitment-management/update-{id}.html', [RecruitmentRequirementController::class, 'update']);
});
Route::post('/recruitment-management/update-{id}.html', [RecruitmentRequirementController::class, 'update']);


Route::group(['middleware' => ['can:recruitment-management-delete']], function () {
    Route::post('/recruitment-management/delete-{id}.html', [RecruitmentRequirementController::class, 'destroy'])->name('recruitment-managements.destroy');
});





// Tin tuyển dụng
Route::group(['middleware' => ['can:job-new-list']], function () {
    Route::get('/job-new/job-news.html', [JobNewController::class, 'index'])->name('job-news.index');
    Route::get('/job-new/show-{id}.html', [JobNewController::class, 'show'])->name('job-news.show');
});

Route::group(['middleware' => ['can:job-new-create']], function () {
    // Route::post('/job-new/create.html', [JobNewController::class, 'store'])->name('job-news.create');
});
Route::post('/job-new/create.html', [JobNewController::class, 'store'])->name('job-news.create');

Route::group(['middleware' => ['can:job-new-edit']], function () {
    Route::get('/job-new/update-{id}.html', [JobNewController::class, 'edit'])->name('job-news.edit');
    // Route::post('/job-new/update-{id}.html', [JobNewController::class, 'update']);
});
Route::post('/job-new/update-{id}.html', [JobNewController::class, 'update']);


Route::group(['middleware' => ['can:job-new-delete']], function () {
    Route::post('/job-new/delete-{id}.html', [JobNewController::class, 'destroy'])->name('job-news.destroy');
});



// Ứng viên
Route::group(['middleware' => ['can:candidate-repository-list']], function () {
    Route::get('/candidate-repository/candidate-repositories.html', [CandidateRepositoryController::class, 'index'])->name('candidate-repositories.index');
    Route::get('/candidate-repository/show-{id}.html', [CandidateRepositoryController::class, 'show'])->name('candidate-repositories.show');
});

Route::group(['middleware' => ['can:candidate-repository-create']], function () {
    Route::post('/candidate-repository/create.html', [CandidateRepositoryController::class, 'store'])->name('candidate-repositories.create');
});

Route::group(['middleware' => ['can:candidate-repository-edit']], function () {
    Route::get('/candidate-repository/update-{id}.html', [CandidateRepositoryController::class, 'edit'])->name('candidate-repositories.edit');
    Route::post('/candidate-repository/update-{id}.html', [CandidateRepositoryController::class, 'update']);
});


// Công ty
Route::group(['middleware' => ['can:company-list']], function () {
    // Route::get('/company/companies.html', [CompanyController::class, 'index'])->name('companies.index');
    // Route::get('/company/show-{id}.html', [CompanyController::class, 'show'])->name('companies.show');
});
Route::get('/company/companies.html', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/company/show-{id}.html', [CompanyController::class, 'show'])->name('companies.show');

Route::group(['middleware' => ['can:company-create']], function () {
    // Route::post('/company/create.html', [CompanyController::class, 'store'])->name('companies.create');
});
Route::post('/company/create.html', [CompanyController::class, 'store'])->name('companies.create');

Route::group(['middleware' => ['can:company-edit']], function () {
    // Route::get('/company/update-{id}.html', [CompanyController::class, 'edit'])->name('companies.edit');
    // Route::post('/company/update-{id}.html', [CompanyController::class, 'update']);
});
Route::get('/company/update-{id}.html', [CompanyController::class, 'edit'])->name('companies.edit');
Route::post('/company/update-{id}.html', [CompanyController::class, 'update']);



Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware([StartSession::class])->post('select-company', [EmployerController::class, 'selectCompany']);
    Route::get('/get-all-jobs', [CandidateController::class, 'getAllJobs']);
    Route::get('/get-all-job-news-{number}', [CandidateController::class, 'getAllJobNews']);
});

Route::get('/get-all-jobs', [CandidateController::class, 'getAllJobs']);






Route::post('/dang-nhap', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $token = $user->createToken('auth_token');

    return response()->json([
        'access_token' => $token->plainTextToken,
        'token_type' => 'Bearer',
    ]);
});


Route::post('/dang-xuat', function (Request $request) {
    // Xóa token hiện tại (đang sử dụng)
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Successfully logged out']);
})->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    $user = Auth::user();
    return $user;
})->middleware('auth:sanctum');


// Route::post('/dang-xuat', function (Request $request) {
//     // Xóa tất cả token của người dùng
//     $request->user()->tokens()->delete();

//     return response()->json(['message' => 'Successfully logged out from all devices']);
// })->middleware('auth:sanctum');
