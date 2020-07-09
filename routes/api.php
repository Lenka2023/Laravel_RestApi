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
/*Route::get('/v1', function () {
    return 'get api v1';
});
Route::post('/v1', function () {
    return 'post api v1';
});*/
/*Route::any('/v1', function () {
    return 'any api v1';
});*/
/*Route::get('/v1/users/{id?}/{code?}', function ($id=null, $code=null) {
    return 'users='.$id.'code='.$code;
})->where(['id'=>'^.{36}$', 'code'=>'[0-9]+']);*/
/*Route::prefix('/v1/products')->group(function() {
    Route::get('/', 'Api\ProductsResource@index');
    Route::get('/{id?}/{code?}', 'Api\ProductsResource@show');

});*/
/*Route::apiResource('/v1/products', 'Api\ProductsResource');
Route::apiResource('/v1/orders', 'Api\OrdersResource');*/
Route::apiResources(['/v1/orders'=> 'Api\OrdersResource', '/v1/products'=> 'Api\ProductsResource']);
