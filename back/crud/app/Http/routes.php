<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return view('home');
});

//Routes to edit sales 
$app->get('/sales/edit/{banner}', 'App\Http\Controllers\SalesController@editSales');
$app->post('/sales/save', 'App\Http\Controllers\SalesController@saveSales');

//route to get sales :: only to be accessed by frontend
$app->get('/sales/{banner}', 'App\Http\Controllers\SalesController@getSales');

//Route to edit pie charts
$app->get('/pie/edit/{banner}', 'App\Http\Controllers\PieController@editPie');
$app->post('/pie/save', 'App\Http\Controllers\PieController@savePie');

//route to get sales :: only to be accessed by frontend
$app->get('/pie/{banner}', 'App\Http\Controllers\PieController@getPie');