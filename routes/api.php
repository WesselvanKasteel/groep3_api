<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProfileController;
use App\Models\Skill;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});


Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function() {
    Route::get('/', [ProfileController::class, 'show']);
    Route::put('/edit', [ProfileController::class, 'edit']);
    Route::post('/edit/picture', [ProfileController::class, 'uploadProfilePicture']);
});

Route::group(['prefix' => 'skills', 'middleware' => 'auth:api'], function() {
    Route::get('/', [SkillController::class, 'index']);
    Route::post('/store', [SkillController::class, 'store']);
});
