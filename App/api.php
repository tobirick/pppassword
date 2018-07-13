<?php

use \Core\Middleware;

// USER ROUTES
$router->get('/api/users', Middleware::userRoute('API\UserController@index'), 'api.users');
$router->post('/api/users', Middleware::userRoute('API\UserController@store'), 'api.users.store');
$router->get('/api/users/[i:userId]', Middleware::userRoute('API\UserController@show'), 'api.users.show');
$router->put('/api/users/[i:userId]', Middleware::userRoute('API\UserController@update'), 'api.users.update');
$router->delete('/api/users/[i:userId]', Middleware::userRoute('API\UserController@delete'), 'api.users.delete');

// USER ROLE ROUTES
$router->get('/api/user-roles', 'API\UserRoleController@index', 'api.user-roles');
$router->post('/api/user-roles', Middleware::userRoute('API\UserRoleController@store'), 'api.user-roles.store');
$router->get('/api/user-roles/[i:userRoleId]', Middleware::userRoute('API\UserRoleController@show'), 'api.user-roles.show');
$router->put('/api/user-roles/[i:userRoleId]', Middleware::userRoute('API\UserRoleController@update'), 'api.user-roles.update');
$router->delete('/api/users/[i:userRoleId]', Middleware::userRoute('API\UserRoleController@delete'), 'api.user-roles.delete');

// CLIENT ROUTES
$router->get('/api/clients', Middleware::userRoute('API\ClientController@index'), 'api.clients');
$router->get('/api/clients/create', Middleware::userRoute('API\ClientController@create'), 'api.clients.create');
$router->post('/api/clients', Middleware::userRoute('API\ClientController@store'), 'api.clients.store');
$router->get('/api/clients/[i:clientId]', Middleware::userRoute('API\ClientController@show'), 'api.clients.show');
$router->put('/api/clients/[i:clientId]', Middleware::userRoute('API\ClientController@update'), 'api.clients.update');
$router->delete('/api/clients/[i:clientId]', Middleware::userRoute('API\ClientController@delete'), 'api.clients.delete');

// FOLDER ROUTES
$router->get('/api/folders', Middleware::userRoute('API\FoldersController@index'), 'api.folders');
$router->post('/api/folders', Middleware::userRoute('API\FoldersController@store'), 'api.folders.store');
$router->get('/api/folders/[i:folderId]', Middleware::userRoute('API\FoldersController@show'), 'api.folders.show');
$router->put('/api/folders/[i:folderId]', Middleware::userRoute('API\FoldersController@update'), 'api.folders.update');
$router->delete('/api/folders/[i:folderId]', Middleware::userRoute('API\FoldersController@delete'), 'api.folders.delete');

// PASSWORD ROUTES
$router->get('/api/passwords', Middleware::userRoute('API\PasswordController@index'), 'api.passwords');
$router->post('/api/passwords', Middleware::userRoute('API\PasswordController@store'), 'api.passwords.store');
$router->get('/api/passwords/[i:passwordId]', Middleware::userRoute('API\PasswordController@show'), 'api.passwords.show');
$router->put('/api/passwords/[i:passwordId]', Middleware::userRoute('API\PasswordController@update'), 'api.passwords.update');
$router->delete('/api/passwords/[i:passwordId]', Middleware::userRoute('API\PasswordController@delete'), 'api.passwords.delete');