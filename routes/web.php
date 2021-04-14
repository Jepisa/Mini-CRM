<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
Auth::routes(['register' => false, 'reset' => false]);

Route::redirect('/', '/companies', 301);
Route::middleware(['auth'])->group(function () {

    //Companies
    Route::get('/companies', 'CompanyController@index')->name('company.index');
    
    Route::get('company/create', 'CompanyController@create')->name('company.create');
    Route::post('company/create', 'CompanyController@store')->name('company.store');
    Route::get('company/{companyName}/edit', 'CompanyController@edit')->name('company.edit');
    Route::get('company/{companyName}', 'CompanyController@show')->name('company.show');
    Route::put('company/{companyName}', 'CompanyController@update')->name('company.update');
    Route::delete('company/{companyName}', 'CompanyController@destroy')->name('company.destroy');

    //Employees
    Route::get('/employees', 'EmployeeController@index')->name('employee.index');
    Route::get('employee/create', 'EmployeeController@create')->name('employee.create');
    Route::post('employee/create', 'EmployeeController@store')->name('employee.store');
    Route::get('employee/{employeeName}/edit', 'EmployeeController@edit')->name('employee.edit');
    Route::get('employee/{employeeName}', 'EmployeeController@show')->name('employee.show');
    Route::put('employee/{employeeName}', 'EmployeeController@update')->name('employee.update');
    Route::delete('employee/{employeeName}', 'EmployeeController@destroy')->name('employee.destroy');
});

Route::post('languageEs', 'LanguageController@es')->name('languageEs');
Route::post('languageEn', 'LanguageController@en')->name('languageEn');
