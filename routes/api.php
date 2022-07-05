<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/emp-list', 'PIM\Employee\EmployeeController@EmpListAPI');
Route::get('/emp-detail', 'PIM\Employee\EmployeeController@EmpDetailListAPI');
Route::get('/emp/{id}', 'PIM\Employee\EmployeeController@EmpDetailByIdAPI');
Route::get('/dept-list', 'Admin\Job\JobController@jobcategoryAPI')->name('job_category_list');
Route::get('/jobtitle-list', 'Admin\Job\JobController@jobAPI')->name('job_category_list');
Route::get('/leave/{id}', 'Leave\Employee\LeaveController@LeaveAPI')->name('leave_api');
Route::get('/leave-type', 'Leave\Employee\LeaveController@LeaveTypeAPI')->name('leave_api');
Route::post('/entry-leave', 'Leave\Employee\LeaveController@saveMyLeaveAPI')->name('save_my_leave_api');
Route::get('/data-leave/{id}', 'Leave\Employee\LeaveController@myleaveGetDataAPI')->name('data_my_leave_api');
Route::get('/data-holiday/{year}', 'Leave\Configuration\ConfigurationController@holidayGetDataAPI')->name('data_holiday_api');