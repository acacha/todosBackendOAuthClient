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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => 'http://localhost:8084/auth/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://localhost:8083/oauth/authorize?'.$query);
});

Route::get('/auth/callback', function () {
    $http = new GuzzleHttp\Client;
    $response = $http->post('http://localhost:8083/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '1',
            'client_secret' => 'tInQq8ZEkGDldECKJ97yz7KcZxsneV6nfCBsm5ma',
            'redirect_uri' => 'http://localhost:8084/auth/callback',
            'code' => Request::input('code'),
        ],
    ]);

    $json = json_decode((string) $response->getBody(), true);

    //TODO
    $response = $http->get('http://localhost:8083/api/v1/tasks', [
        'header' => [
            'token' => $token
        ],
    ]);
});
Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    Route::get('tasks', 'TasksController@index')->name('tasks');



});
