<?php

use Illuminate\Http\Request;

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


// 一般用法
Route::middleware('guest:api')->get('/phpinfo', function () {
    return phpinfo();
});

// 包含参数
Route::get('/id/{id}', function ($id) {
    return $id;
})->middleware('api');

// 包含RegEx
Route::get('userRx/{name}', function ($name) {
    return 'String:' . $name;
})->where(['name'=>'[A-Za-z]+'])->middleware('api');

// 命名路由
Route::get('user/profile', ['as' => 'route_name', function () {
    $url = route('route_name');
    return $url;
    // return redirect()->route('profile');
}])->middleware('api');

//Route::get('user/profile', function () {
//    $url = route('route_name');
//    return $url;
//    // return redirect()->route('profile');
//})->name('route_name')->middleware('api');

// 路由分组与前缀
Route::group(['middleware' => 'api', 'prefix' => 'part-1'], function () {
    Route::get('/', function ()    {
        return 'part-1';
    });

    Route::get('/part-2', function () {
        return 'part-1/part-2';
    });
});