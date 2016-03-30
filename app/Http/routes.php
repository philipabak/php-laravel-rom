<?php

use Illuminate\Support\Facades\Redirect;

Route::pattern('id', '[0-9]+');
Route::pattern('country', '[a-zA-Z0-9-]+');
Route::pattern('agency', '[a-zA-Z0-9-]+');
Route::pattern('id2', '[0-9]+');
Route::pattern('slug', '[a-zA-Z0-9-]+');
Route::pattern('slug1', '[a-zA-Z0-9-]+');
Route::pattern('slug2', '[a-zA-Z0-9-]+');
Route::pattern('slug3', '[a-zA-Z0-9-]+');
Route::pattern('slug4', '[a-zA-Z0-9-]+');
Route::pattern('job_slug', '[a-zA-Z0-9-]+');
Route::pattern('company_slug', '[a-zA-Z0-9-]+');
Route::pattern('code', '[a-zA-Z0-9-]+');
Route::pattern('company_id', '[0-9]+');
Route::pattern('user_id', '[0-9]+');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* main */
Route::get('/aaa',                     ['as' => 'user.user.aaa',                'uses' => 'User\UserController@aaa']);
Route::get('admin',                     ['as' => 'user.user.index',                'uses' => 'User\UserController@index']);
Route::post('admin/login',              ['as' => 'user.user.login',                'uses' => 'User\UserController@login']);
Route::get('admin/forgetpassword',      ['as' => 'user.user.forgetpassword',       'uses' => 'User\UserController@forgetpssword']);

/* frontend */
Route::get('/',                         ['as' => 'user.user.home',                 'uses' => 'User\UserController@home']);
Route::get('/search',                   ['as' => 'user.user.search',               'uses' => 'User\UserController@search']);
Route::get('/searchResult/{slug?}',     ['as' => 'user.user.searchResult',         'uses' => 'User\UserController@searchResult']);
Route::get('/signin',                   ['as' => 'user.user.signin',               'uses' => 'User\UserController@signin']);
Route::get('/userLogout',               ['as' => 'user.user.userLogout',           'uses' => 'User\UserController@userLogout']);
Route::post('/userLogin',               ['as' => 'user.user.userLogin',            'uses' => 'User\UserController@userLogin']);
Route::post('/userForgetpassword',      ['as' => 'user.user.userForgetpassword',   'uses' => 'User\UserController@userForgetpassword']);
Route::post('/resetPassword',           ['as' => 'user.user.resetPassword',        'uses' => 'User\UserController@resetPassword']);
Route::post('/verifyEmail',             ['as' => 'user.user.verifyEmail',          'uses' => 'User\UserController@verifyEmail']);
Route::post('/doResetPassword',         ['as' => 'user.user.doResetPassword',      'uses' => 'User\UserController@doResetPassword']);
Route::post('/createAccount',           ['as' => 'user.user.createAccount',        'uses' => 'User\UserController@createAccount']);
Route::post('/uploadAccountImage',      ['as' => 'user.user.uploadAccountImage',   'uses' => 'User\UserController@uploadAccountImage']);
// Profile
Route::get('/dashboard',         ['as' => 'user.profile.dashboard',         'uses' => 'User\ProfileController@dashboard']);
Route::get('/messages',          ['as' => 'user.profile.messages',          'uses' => 'User\ProfileController@messages']);
Route::get('/community',         ['as' => 'user.profile.community',         'uses' => 'User\ProfileController@community']);
Route::get('/downloadList',      ['as' => 'user.profile.downloadList',      'uses' => 'User\ProfileController@downloadList']);
Route::get('/downloadHistory',   ['as' => 'user.profile.downloadHistory',   'uses' => 'User\ProfileController@downloadHistory']);
Route::get('/purchaseHistory',   ['as' => 'user.profile.purchaseHistory',   'uses' => 'User\ProfileController@purchaseHistory']);
Route::post('/profileUpdate',           ['as' => 'user.profile.updateProfileInforms',   'uses' => 'User\ProfileController@updateProfileInforms']);
Route::get('/getMessageContent/{id?}',  ['as' => 'user.profile.getMessageContent',      'uses' => 'User\ProfileController@getMessageContent']);
Route::get('/sendReplyMessage/{id?}',   ['as' => 'user.profile.sendReplyMessage',       'uses' => 'User\ProfileController@sendReplyMessage']);
Route::get('/removeMessage/{id?}',      ['as' => 'user.profile.removeMessage',          'uses' => 'User\ProfileController@removeMessage']);
Route::get('/sendNewMessage',           ['as' => 'user.profile.sendNewMessage',         'uses' => 'User\ProfileController@sendNewMessage']);

// Category
Route::get('/getCategory',              ['as' => 'user.category.getCategory',           'uses' => 'User\CategoryController@getCategory']);
Route::get('/files/{slug1?}/{slug?}',   ['as' => 'user.category.listCategory',          'uses' => 'User\CategoryController@listCategory']);

// Details
Route::get('/files/{slug?}/{slug1?}/{slug2?}/{slug3?}',     ['as' => 'user.details.details',        'uses' => 'User\DetailsController@details']);
Route::get('/ajax/addLikeDislike/{slug?}/{id?}',            ['as' => 'user.details.addLikeDislike', 'uses' => 'User\DetailsController@addLikeDislike']);
Route::get('/ajax/addComment/{id?}',                        ['as' => 'user.details.addComment',     'uses' => 'User\DetailsController@addComment']);
Route::get('/ajax/addDownloadList/{id?}',                   ['as' => 'user.details.addComment',     'uses' => 'User\DetailsController@addDownloadList']);

// download ajax
Route::get('/ajax/fileDownload/{id?}',    ['as' => 'user.details.fileDownload',          'uses' => 'User\DetailsController@fileDownload']);

/* backend */

// Dashboard
Route::get('admin/dashboard',           ['as' => 'admin.dashboard.index',          'uses' => 'Admin\DashboardController@index']);
Route::get('admin/viewProfile',         ['as' => 'admin.dashboard.viewProfile',    'uses' => 'Admin\DashboardController@viewProfile']);
Route::get('admin/changePassword',      ['as' => 'admin.dashboard.changePassword', 'uses' => 'Admin\DashboardController@changePassword']);
Route::get('admin/screenLock',          ['as' => 'admin.dashboard.screenLock',     'uses' => 'Admin\DashboardController@screenLock']);
Route::get('logout',                    ['as' => 'admin.dashboard.logout',         'uses' => 'Admin\DashboardController@logout']);

// Messages
Route::get('admin/messages/inbox',      ['as' => 'admin.messages.inbox',           'uses' => 'Admin\MessagesController@inbox']);
Route::post('admin/messages/composeNew',['as' => 'admin.messages.composeNew',      'uses' => 'Admin\MessagesController@composeNew']);
Route::post('admin/messages/reply',     ['as' => 'admin.messages.reply',           'uses' => 'Admin\MessagesController@reply']);
Route::get('admin/messages/sentMail',   ['as' => 'admin.messages.sentMail',        'uses' => 'Admin\MessagesController@sentMail']);
Route::get('admin/messages/trash',      ['as' => 'admin.messages.trash',           'uses' => 'Admin\MessagesController@trash']);
Route::get('admin/messages/details/{id?}',         ['as' => 'admin.messages.details',        'uses' => 'Admin\MessagesController@details']);
Route::get('admin/messages/messageTrash/{id?}',    ['as' => 'admin.messages.messageTrash',   'uses' => 'Admin\MessagesController@messageTrash']);
Route::get('admin/messages/messageDelete/{id?}',   ['as' => 'admin.messages.messageDelete',  'uses' => 'Admin\MessagesController@messageDelete']);

// Users
Route::get('admin/users/add',           ['as' => 'admin.users.addUser',            'uses' => 'Admin\UsersController@addUser']);
Route::post('admin/users/addNew',       ['as' => 'admin.users.addNewUser',         'uses' => 'Admin\UsersController@addNew']);
Route::get('admin/users',               ['as' => 'admin.users.manageUser',         'uses' => 'Admin\UsersController@manageUser']);
Route::get('admin/users/view/{id?}',    ['as' => 'admin.users.view',               'uses' => 'Admin\UsersController@view']);
Route::get('admin/users/edit/{id?}',    ['as' => 'admin.users.edit',               'uses' => 'Admin\UsersController@edit']);
Route::post('admin/users/update/{id?}',  ['as' => 'admin.users.update',             'uses' => 'Admin\UsersController@update']);
Route::get('admin/users/enable/{id?}',  ['as' => 'admin.users.enable',             'uses' => 'Admin\UsersController@enable']);
Route::get('admin/users/disable/{id?}', ['as' => 'admin.users.disable',            'uses' => 'Admin\UsersController@disable']);
Route::get('admin/users/delete/{id?}',  ['as' => 'admin.users.delete',             'uses' => 'Admin\UsersController@delete']);

// Files List
Route::get('admin/files/add',           ['as' => 'admin.files.addFile',            'uses' => 'Admin\FilesController@addFile']);
Route::post('admin/files/addNew',       ['as' => 'admin.files.addNewFile',         'uses' => 'Admin\FilesController@addNew']);
Route::get('admin/files',               ['as' => 'admin.files.manageFile',         'uses' => 'Admin\FilesController@manageFile']);
Route::get('admin/files/view/{id?}',    ['as' => 'admin.files.view',               'uses' => 'Admin\FilesController@view']);
Route::get('admin/files/edit/{id?}',    ['as' => 'admin.files.edit',               'uses' => 'Admin\FilesController@edit']);
Route::post('admin/files/update/{id?}', ['as' => 'admin.files.update',             'uses' => 'Admin\FilesController@update']);
Route::get('admin/files/delete/{id?}',  ['as' => 'admin.files.delete',             'uses' => 'Admin\FilesController@delete']);

// Categories
Route::get('admin/categories/add',      ['as' => 'admin.categories.addCategory',    'uses' => 'Admin\CategoriesController@addCategory']);
Route::post('admin/categories/addNew',  ['as' => 'admin.categories.addNewCategory', 'uses' => 'Admin\CategoriesController@addNew']);
Route::get('admin/categories',          ['as' => 'admin.categories.manageCategory', 'uses' => 'Admin\CategoriesController@manageCategory']);
Route::get('admin/categories/view/{id?}',    ['as' => 'admin.categories.view',      'uses' => 'Admin\CategoriesController@view']);
Route::get('admin/categories/edit/{id?}',    ['as' => 'admin.categories.edit',      'uses' => 'Admin\CategoriesController@edit']);
Route::post('admin/categories/update/{id?}', ['as' => 'admin.categories.update',    'uses' => 'Admin\CategoriesController@update']);
Route::get('admin/categories/enable/{id?}',  ['as' => 'admin.categories.enable',    'uses' => 'Admin\CategoriesController@enable']);
Route::get('admin/categories/disable/{id?}', ['as' => 'admin.categories.disable',   'uses' => 'Admin\CategoriesController@disable']);
Route::get('admin/categories/delete/{id?}',  ['as' => 'admin.categories.delete',    'uses' => 'Admin\CategoriesController@delete']);

// CMS Pages
Route::get('admin/pages/add',           ['as' => 'admin.pages.addPage',             'uses' => 'Admin\PagesController@addPage']);
Route::post('admin/pages/addNew',       ['as' => 'admin.pages.addNewPage',          'uses' => 'Admin\PagesController@addNew']);
Route::get('admin/pages',               ['as' => 'admin.pages.managePage',          'uses' => 'Admin\PagesController@managePage']);
Route::get('admin/pages/view/{id?}',    ['as' => 'admin.pages.view',                'uses' => 'Admin\PagesController@view']);
Route::get('admin/pages/edit/{id?}',    ['as' => 'admin.pages.edit',                'uses' => 'Admin\PagesController@edit']);
Route::post('admin/pages/update/{id?}', ['as' => 'admin.pages.update',              'uses' => 'Admin\PagesController@update']);
Route::get('admin/pages/enable/{id?}',  ['as' => 'admin.pages.enable',              'uses' => 'Admin\PagesController@enable']);
Route::get('admin/pages/disable/{id?}', ['as' => 'admin.pages.disable',             'uses' => 'Admin\PagesController@disable']);
Route::get('admin/pages/delete/{id?}',  ['as' => 'admin.pages.delete',              'uses' => 'Admin\PagesController@delete']);

// News
Route::get('admin/news/add',            ['as' => 'admin.news.addNews',              'uses' => 'Admin\NewsController@addNews']);
Route::post('admin/news/addNew',        ['as' => 'admin.news.addNewNews',           'uses' => 'Admin\NewsController@addNew']);
Route::get('admin/news',                ['as' => 'admin.news.manageNews',           'uses' => 'Admin\NewsController@manageNews']);
Route::get('admin/news/view/{id?}',     ['as' => 'admin.news.view',                 'uses' => 'Admin\NewsController@view']);
Route::get('admin/news/edit/{id?}',     ['as' => 'admin.news.edit',                 'uses' => 'Admin\NewsController@edit']);
Route::post('admin/news/update/{id?}',  ['as' => 'admin.news.update',               'uses' => 'Admin\NewsController@update']);
Route::get('admin/news/enable/{id?}',   ['as' => 'admin.news.enable',               'uses' => 'Admin\NewsController@enable']);
Route::get('admin/news/disable/{id?}',  ['as' => 'admin.news.disable',              'uses' => 'Admin\NewsController@disable']);
Route::get('admin/news/delete/{id?}',   ['as' => 'admin.news.delete',               'uses' => 'Admin\NewsController@delete']);

// Advertisement
Route::get('admin/advertisement',       ['as' => 'admin.advertisement.index',       'uses' => 'Admin\AdvertisementController@index']);

// Memberships
Route::get('admin/memberships/add',     ['as' => 'admin.memberships.addMembership', 'uses' => 'Admin\MembershipsController@addMembership']);
Route::post('admin/memberships/addNew', ['as' => 'admin.memberships.addNewMembership', 'uses' => 'Admin\MembershipsController@addNew']);
Route::get('admin/memberships',         ['as' => 'admin.memberships.manageMembership', 'uses' => 'Admin\MembershipsController@manageMembership']);
Route::get('admin/memberships/view/{id?}',   ['as' => 'admin.memberships.view',        'uses' => 'Admin\MembershipsController@view']);
Route::get('admin/memberships/edit/{id?}',   ['as' => 'admin.memberships.edit',        'uses' => 'Admin\MembershipsController@edit']);
Route::post('admin/memberships/update/{id?}',['as' => 'admin.memberships.update',      'uses' => 'Admin\MembershipsController@update']);
Route::get('admin/memberships/delete/{id?}', ['as' => 'admin.memberships.delete',      'uses' => 'Admin\MembershipsController@delete']);

// Usergroups
Route::get('admin/usergroups/add',      ['as' => 'admin.usergroups.addUsergroup',    'uses' => 'Admin\UsergroupsController@addUsergroup']);
Route::post('admin/usergroups/addNew',  ['as' => 'admin.usergroups.addNewUsergroup', 'uses' => 'Admin\UsergroupsController@addNew']);
Route::get('admin/usergroups',          ['as' => 'admin.usergroups.manageUsergroup', 'uses' => 'Admin\UsergroupsController@manageUsergroup']);
Route::get('admin/usergroups/view/{id?}',   ['as' => 'admin.usergroups.view',        'uses' => 'Admin\UsergroupsController@view']);
Route::get('admin/usergroups/edit/{id?}',   ['as' => 'admin.usergroups.edit',        'uses' => 'Admin\UsergroupsController@edit']);
Route::post('admin/usergroups/update/{id?}',['as' => 'admin.usergroups.update',      'uses' => 'Admin\UsergroupsController@update']);
Route::get('admin/usergroups/enable/{id?}', ['as' => 'admin.usergroups.enable',      'uses' => 'Admin\UsergroupsController@enable']);
Route::get('admin/usergroups/disable/{id?}',['as' => 'admin.usergroups.disable',     'uses' => 'Admin\UsergroupsController@disable']);
Route::get('admin/usergroups/delete/{id?}', ['as' => 'admin.usergroups.delete',      'uses' => 'Admin\UsergroupsController@delete']);
