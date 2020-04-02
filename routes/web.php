<?php

use App\Models\Client;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

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
Auth::routes();

Route::resource('groups', 'GroupsController');
Route::resource('log', 'LogController');
Route::resource('users', 'UsersController');
Route::resource('clients', 'ClientsController');
Route::get('/', 'ClientsController@index')->name('client');

Route::get('/change-password', function () {
    $user = User::find(auth()->user()->id);
    return view('users.edit', compact('user'));
});

Route::get('/groups/{id}/new-user', function($id) {
    return view('groups.new-user', compact('id'));
});

Route::post('/groups/create-user', function(Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $group = Group::find($request->get("id"));

    $user = new User([
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'password' => Hash::make($request->get('password')),
    ]);

    $user->group()->associate($group);
    $user->save();

    return redirect('/groups/'.$group->id)->with('sucess', 'Cliente salvo com sucesso');
});
