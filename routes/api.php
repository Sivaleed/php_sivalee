<?php

use App\Http\Controllers\EmployeeController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/employees/{id}', function(Request $request, $id) {     
    $employeeController = new EmployeeController();
    return $employeeController->find($id);       
})->name('api_employees');