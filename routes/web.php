<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/search documents','SearchController@results')->name('document.search');
Route::get('/mode1','SearchController@mode1')->name('mode1.change');
Route::get('/mode2','SearchController@mode2')->name('mode2.change');
Route::post('/send message','Searchcontroller@message')->name('send.message');
Route::post('/type/update','Searchcontroller@update');

Auth::routes();

Route::redirect('/home', '/admin/home');
Route::group(['prefix' => 'admin','middleware'=>'admin'], function () 
{
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/documents', 'Admin\DocumentsController@index')->name('admin.documents');

    Route::get('/client','Admin\ClientsController@index')->name('admin.client');
    Route::get('/client add','Admin\ClientsController@add')->name('admin.client.add');
    Route::post('/client save','Admin\ClientsController@save')->name('admin.client.save');
    Route::get('/client edit/{client_edit}','Admin\ClientsController@edit')->name('admin.client.edit');
    Route::post('/client update/{client_update}','Admin\ClientsController@update')->name('admin.client.update');
    Route::get('/client delete/{client_delete}','Admin\ClientsController@delete')->name('admin.client.delete');

    Route::get('/agent','Admin\AgentsController@index')->name('admin.agent');
    Route::get('/agent add','Admin\AgentsController@add')->name('admin.agent.add');
    Route::post('/agent save','Admin\AgentsController@save')->name('admin.agent.save');
    Route::get('/agent edit/{agent_edit}','Admin\AgentsController@edit')->name('admin.agent.edit');
    Route::post('/agent update/{agent_update}','Admin\AgentsController@update')->name('admin.agent.update');

    Route::get('/item type','Admin\DocumentsController@addType')->name('admin.add.type');
    Route::post('/item save','Admin\DocumentsController@saveType')->name('admin.save.type');
    Route::get('/type delete/{type_delete}','Admin\ClientsController@delete')->name('admin.type.delete');
    
    Route::get('/lost item', 'Admin\ItemController@lostAdd')->name('admin.add.lost');
    Route::post('/save item', 'Admin\ItemController@addLost')->name('admin.save.lost');
    
    Route::get('/found item', 'Admin\ItemController@foundAdd')->name('admin.add.found');
    Route::post('/save item found', 'Admin\ItemController@addFound')->name('admin.save.found');

    Route::get('/new documents', 'Admin\DocumentsController@newReports')->name('admin.documents.new');
    Route::get('/pending documents/{pending_document}', 'Admin\DocumentsController@pendingDocument')->name('admin.documents.pending');

    Route::get('/search item', 'Admin\SearchController@search_page')->name('admin.search');
    Route::get('/searching', 'Admin\SearchController@results2')->name('admin.document.search');

    Route::get('/my found document/{my_found_document}','Admin\ItemController@myFounds')->name('admin.myfound.document');

    Route::get('/inbox', 'Admin\MailController@inbox')->name('admin.inbox');
    Route::get('/read message/{read_message}', 'Admin\MailController@read')->name('admin.read');

    
    Route::get('/documents received/{document_received}','Admin\DocumentsController@received')->name('admin.received.document');

    
    Route::get('/documents approval/{document_approval}','Admin\DocumentsController@approve')->name('admin.approve.document');

    Route::get('/profile','Admin\ProfileController@index')->name('admin.profile');
    Route::post('/profile email update','Admin\ProfileController@update_email')->name('admin.update.email');
    Route::post('/profile password update','Admin\ProfileController@update_password')->name('admin.update.password');

    Route::get('/requested','Admin\ItemController@requested')->name('document.requested');
    Route::get('/requested_confirm/{request_confirm}','Admin\ItemController@requested_confirm')->name('document.requested.accept');
});


Route::group(['prefix' => 'agent','middleware'=>'agent'], function () 
{
    Route::get('/', 'HomeController@agent_index')->name('agent');

    Route::get('/lost item', 'Agent\ItemController@lostAdd')->name('agent.add.lost');
    Route::post('/save item', 'Agent\ItemController@addLost')->name('agent.save.lost');
    
    Route::get('/found item', 'Agent\ItemController@foundAdd')->name('agent.add.found');
    Route::post('/save item found', 'Agent\ItemController@addFound')->name('agent.save.found');

    Route::get('/search item', 'Agent\SearchController@search_page')->name('agent.search');
    Route::get('/searching', 'Agent\SearchController@results2')->name('agent.document.search');
    
    Route::get('/my found document/{my_found_document}','Agent\ItemController@myFounds')->name('agent.myfound.document');

    Route::get('/documents list','Agent\ItemController@documents')->name('agent.all.document');
    Route::get('/documents approval/{document_approval}','Agent\ItemController@approve')->name('agent.approve.document');
    Route::get('/documents received/{document_received}','Agent\ItemController@received')->name('agent.received.document');
});


Route::group(['prefix' => 'client','middleware'=>'client'], function () {

    Route::get('/', 'HomeController@client_index')->name('client');

    Route::get('/my found document/{my_found_document}','Client\ItemController@myFound')->name('client.myfound.document');
    Route::get('/my lost document','Client\ItemController@myLost')->name('client.mylost.document');

    Route::get('/lost item', 'Client\ItemController@lostAdd')->name('client.add.lost');
    Route::post('/save item', 'Client\ItemController@addLost')->name('client.save.lost');
    
    Route::get('/found item', 'Client\ItemController@foundAdd')->name('client.add.found');
    Route::post('/save item found', 'Client\ItemController@addFound')->name('client.save.found');

    Route::get('/search item', 'SearchController@search_page')->name('client.search');
    Route::get('/searching', 'SearchController@results2')->name('client.document.search');

    Route::get('/request_info/{request_info}','Client\ItemController@request_permission')->name('request.permission');

    Route::get('/client profile','Client\ProfileController@index')->name('client.profile');
    Route::post('/client profile email update','Client\ProfileController@update_email')->name('client.update.email');
    Route::post('/client profile password update','Client\ProfileController@update_password')->name('client.update.password');

    Route::get('/my document','Client\DocumentController@index')->name('client.document');
    Route::post('/save my document','Client\DocumentController@save')->name('client.document.save');

    Route::get('/fetch my document','Client\DocumentController@fetch')->name('client.fetch.own.document');
});
