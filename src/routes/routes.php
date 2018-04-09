<?php

Route::group(['prefix' => 'api', 'middleware' => 'api'], function()
{
    Route::resource("users", "TechlifyInc\LaravelUserManagement\Controllers\UserController");
    Route::post('/user/logout', "TechlifyInc\LaravelUserManagement\Controllers\SessionController@destroy");
    Route::get('/user/current', "TechlifyInc\LaravelUserManagement\Controllers\CurrentUserController@show");
    Route::patch("user/current/update-password", "TechlifyInc\LaravelUserManagement\Controllers\UserController@user_password_change_own");
});
