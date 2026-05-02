<?php

use App\Http\Controllers\OnePrincipalController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
   return "Hello World";
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::match(['get', 'post'], '/test-match', function (Request $request) {
    return "You accessed this page using: " . $request->method();
});

Route::any('/test-any', function (Request $request) {
    return "You accessed this page using: " . $request->method();
});

Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {
    return "post: ".$postId . ' comment: ' . $commentId;
});

Route::get('employee/{id}', function (string $name) {
    return $name;
});

//optional route
//Route::get('employee/{name?}', function (string $name = null) {
//    return $name ?? 'Employee';
//})->where('name', '[A-Za-z]+');

Route::get('/search/{search}', function (string $search) {
    return $search;
})->where('search', '.*');

Route::domain('{tenant}.laravel13')->group(function () {
    Route::get('test/{id}', function (string $tenant, string $id) {
        return "Tenant: " . $tenant . ' User ID: ' . $id;
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/amaze', function () {
        return "Admin Dashboard URL";
    });
});

Route::get('user/{user}', function (User $user){
    return $user->email;
})->name('userprofile');

// middleware example
Route::middleware(EnsureTokenIsValid::class)->group(function () {
    Route::get('/profile', function () {
        return "User Profile 1";
    });
});
Route::get('invalid-token', function () {
    return "Invalid token";
});
Route::get('token', function (Request $request) {
    echo $token = $request->session()->token();

    //echo csrf_token();
});

//invokable Controller
Route::get('/invokable', OnePrincipalController::class);

//redirect routes
Route::redirect('/here', '/greeting');
Route::redirect('/there', '/greeting', 301);
Route::permanentRedirect('permanent', '/greeting');
