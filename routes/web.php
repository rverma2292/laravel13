<?php

use App\Http\Controllers\OnePrincipalController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
   return view('greeting', ['name' => 'John Doe']);
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

//resource controller
Route::resource('/photo', \App\Http\Controllers\PhotoController::class);

Route::resources([
    'posts' => \App\Http\Controllers\PostController::class,
    'image' => \App\Http\Controllers\PhotoController::class
]);
Route::get('/unsubscribe/getsignedurl', function () {
     //return URL::signedRoute('unsubscribe', ['user' => '1']);
     //return URL::signedRoute('unsubscribe', ['user' => '1'], absolute: false);
    return URL::temporarySignedRoute('unsubscribe', now()->plus(seconds: 10), ['user' => '1']);
});
Route::get('/unsubscribe/{user}', function (User $user) {
    return $user->email;
})->name('unsubscribe')->middleware('signed');

Route::get('/simple', function () {
    // 1. Try to get the data from cache.
    // If it's NOT there, run the function and store it for 5 seconds.
    $value = Cache::remember('active_users', 5, function () {
        Log::info('--- CACHE MISS: Running Database Query ---');

        $users = User::all(); // Actual DB work

        return "Total Users found: " . $users->count(); // This is what gets saved
    });

    // 2. Return the result so you can see it in the browser
    return $value;
});
//redirect routes
Route::redirect('/here', '/greeting');
Route::redirect('/there', '/greeting', 301);
Route::permanentRedirect('permanent', '/greeting');
