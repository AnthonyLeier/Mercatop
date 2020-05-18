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

Route::middleware(['auth'])->group(function(){

	//Todas as rotas aqui dentro, o usuário precisará estar cadastrado (Usuario Cliente)

	Route::get('/', function () {return view('welcome');})->name('welcome');
	Route::get('/logout', 'UserController@logout');

	Route::middleware(['permissaoAdmin'])->group(function(){
		//Todas as rotas aqui dentro, o usuário precisará estar cadastrado e ser administrador (Usuario Administrador)

		//* Usuários *//
		/* Telas */	
		Route::get('/tela/user/listar', 'UserController@telaListarUsers')->name('tela_listar_users');


		//* Cidades *//
		/* Telas */
		Route::get('/tela/cidade/adicionar', 'CidadeController@telaAdicionarCidade')->name('tela_adicionar_cidade');
		Route::get('/tela/cidade/alterar/{id}', 'CidadeController@telaAlterarCidade')->name('tela_alterar_cidade');				
		Route::get('/tela/cidade/listar', 'CidadeController@telaListarCidade')->name('tela_listar_cidade');
		/* Funções */
		Route::post('/cidade/registrar', 'CidadeController@addCidade')->name('registrar_cidade');
		Route::post('/cidade/atualizar/{id}', 'CidadeController@updateCidade')->name('alterar_cidade');		
		Route::get('/cidade/excluir/{id}', 'CidadeController@deleteCidade')->name('excluir_cidade');			
	});
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

