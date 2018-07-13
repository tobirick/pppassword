<?php

use \Core\Middleware;

// AUTH ROUTES
$router->get('/login', Middleware::guestRoute('AuthController@loginIndex'), 'login.index');
$router->post('/login', Middleware::guestRoute('AuthController@login'), 'login');
$router->get('/logout', Middleware::userRoute('AuthController@logout'), 'logout');
$router->get('/register', Middleware::guestRoute('AuthController@registerIndex'), 'register.index');
$router->post('/register', Middleware::guestRoute('AuthController@register'), 'register');

$router->get('/password/forgot', Middleware::guestRoute('AuthController@passwordForgotIndex'), 'password.forgot.index');
$router->post('/password/forgot', Middleware::guestRoute('AuthController@passwordForgot'), 'password.forgot');

$router->get('/password/reset/[a:token]', Middleware::guestRoute('AuthController@passwordResetIndex'), 'password.reset.index');
$router->post('/password/reset', Middleware::guestRoute('AuthController@passwordReset'), 'password.reset');

// BASE ROUTES
$router->get('/', Middleware::userRoute('IndexController@index'), 'index');

// USER ROUTES
$router->get('/users', Middleware::userRoute('UserController@index'), 'users');
$router->get('/users/create', Middleware::userRoute('UserController@create'), 'users.create');
$router->post('/users', Middleware::userRoute('UserController@store'), 'users.store');
$router->get('/users/[i:userId]', Middleware::userRoute('UserController@show'), 'users.show');
$router->get('/users/[i:userId]/edit', Middleware::userRoute('UserController@edit'), 'users.edit');
$router->put('/users/[i:userId]', Middleware::userRoute('UserController@update'), 'users.update');
$router->delete('/users/[i:userId]', Middleware::userRoute('UserController@delete'), 'users.delete');

// USER ROLE ROUTES
$router->get('/user-roles', Middleware::userRoute('UserRoleController@index'), 'user-roles');
$router->get('/user-roles/create', Middleware::userRoute('UserRoleController@create'), 'user-roles.create');
$router->post('/user-roles', Middleware::userRoute('UserRoleController@store'), 'user-roles.store');
$router->get('/user-roles/[i:userRoleId]', Middleware::userRoute('UserRoleController@show'), 'user-roles.show');
$router->get('/user-roles/[i:userRoleId]/edit', Middleware::userRoute('UserRoleController@edit'), 'user-roles.edit');
$router->put('/user-roles/[i:userRoleId]', Middleware::userRoute('UserRoleController@update'), 'user-roles.update');
$router->delete('/user-roles/[i:userRoleId]', Middleware::userRoute('UserRoleController@delete'), 'user-roles.delete');

// CLIENT ROUTES
$router->get('/clients', Middleware::userRoute('ClientController@index'), 'clients');
$router->get('/clients/create', Middleware::userRoute('ClientController@create'), 'clients.create');
$router->post('/clients', Middleware::userRoute('ClientController@store'), 'clients.store');
$router->get('/clients/[i:clientId]', Middleware::userRoute('ClientController@show'), 'clients.show');
$router->get('/clients/[i:clientId]/edit', Middleware::userRoute('ClientController@edit'), 'clients.edit');
$router->put('/clients/[i:clientId]', Middleware::userRoute('ClientController@update'), 'clients.update');
$router->delete('/clients/[i:clientId]', Middleware::userRoute('ClientController@delete'), 'clients.delete');

// FOLDER ROUTES
$router->get('/folders', Middleware::userRoute('FoldersController@index'), 'folders');
$router->get('/folders/create', Middleware::userRoute('FoldersController@create'), 'folders.create');
$router->post('/folders', Middleware::userRoute('FoldersController@store'), 'folders.store');
$router->get('/folders/[i:folderId]', Middleware::userRoute('FoldersController@show'), 'folders.show');
$router->get('/folders/[i:folderId]/edit', Middleware::userRoute('FoldersController@edit'), 'folders.edit');
$router->put('/folders/[i:folderId]', Middleware::userRoute('FoldersController@update'), 'folders.update');
$router->delete('/folders/[i:folderId]', Middleware::userRoute('FoldersController@delete'), 'folders.delete');

// PASSWORD ROUTES
$router->get('/passwords', Middleware::userRoute('PasswordController@index'), 'passwords');
$router->get('/passwords/create', Middleware::userRoute('PasswordController@create'), 'passwords.create');
$router->post('/passwords', Middleware::userRoute('PasswordController@store'), 'passwords.store');
$router->get('/passwords/[i:passwordId]', Middleware::userRoute('PasswordController@show'), 'passwords.show');
$router->get('/passwords/[i:passwordId]/edit', Middleware::userRoute('PasswordController@edit'), 'passwords.edit');
$router->put('/passwords/[i:passwordId]', Middleware::userRoute('PasswordController@update'), 'passwords.update');
$router->delete('/passwords/[i:passwordId]', Middleware::userRoute('PasswordController@delete'), 'passwords.delete');
