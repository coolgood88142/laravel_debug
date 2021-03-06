<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\IeController;
use App\Http\Controllers\TaskController;
use App\Services\Client;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/main', [MainController::class, 'getMainData']);

Route::get('/keyword', [KeywordController::class, 'getKeywordView']);

// Route::get('/task/{task}',[TaskController::class, 'show']);
// Route::post('/task/create', [TaskController::class, 'create_task']);
// Route::patch('/task{task}/complete', [TaskController::class, 'mark_task_as_completed']);
// Route::delete('/task/{id}', [TaskController::class, 'destroy']);

Route::prefix('task')->group(function () {
    Route::get('/{task}', [TaskController::class, 'show']);
    Route::post('/create', [TaskController::class, 'create_task']);
    Route::patch('{task}/complete', [TaskController::class, 'mark_task_as_completed']);
    Route::delete('/{id}', [TaskController::class, 'destroy']);
});


Route::post('/plus', [MainController::class, 'plus']);

Route::post('/toSubtract', [MainController::class, 'toSubtract']);

Route::post('/multiply', [MainController::class, 'multiply']);

Route::post('/divided', [MainController::class, 'divided']);

Route::get('/computer', function () {
    return view('computer');
});

Route::post('/result', [ComputerController::class, 'result']);

Route::get('/addResult', [ComputerController::class, 'addResult']);

Route::get('/api', function (Client $client) {
    return $client->query();
});

Route::get('/ie', [IeController::class, 'getData']);

Route::post('/save', [IeController::class, 'save'])->name('save');

Route::get('/testData', [MainController::class, 'testData']);
