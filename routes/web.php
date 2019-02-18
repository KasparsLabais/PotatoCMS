<?php

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

Route::get("/", "BasicController@index");

Route::get("/login", "Auth\LoginController@showLoginForm");
Route::post("/login",  "Auth\LoginController@login")->name("login");
Route::post("/logout", "Auth\LoginController@logout")->name("logout");

Route::group(["middleware" => "auth"], function() {

    Route::get("/profile", "Auth\GeneralController@index");

    /*
     * CRUD FOR COMPANIES
     */

    Route::get("/companies", "CompaniesController@index");
    Route::post("/companies", "CompaniesController@addCompany");
    Route::get("/companies/{id}", "CompaniesController@getCompany");
    Route::put("/companies/{id}", "CompaniesController@updateCompany");
    Route::delete("/companies/{id}", "CompaniesController@deleteCompany");

    /*
     * CRUD FOR EMPLOYEE
     */

    Route::get("/employee", "EmployeeController@index");
    Route::post("/employee", "EmployeeController@addEmployee");
    Route::get("/employee/{id}", "EmployeeController@getEmployee");
    Route::put("/employee/{id}", "EmployeeController@updateEmployee");
    Route::delete("/employee/{id}", "EmployeeController@deleteEmployee");


});

