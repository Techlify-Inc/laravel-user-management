<?php

Route::group(['prefix' => 'api', 'middleware' => 'api'], function()
{
    Route::resource("users", "User\UserController");
    Route::post('/user/logout', "User\SessionController@destroy");
    Route::get('/user/current', "User\CurrentUserController@show");
    Route::patch("user/current/update-password", "User\UserController@user_password_change_own");
});
