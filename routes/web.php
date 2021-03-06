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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::middleware(['auth'])->group(function(){

	//Todas as rotas aqui dentro, o usuário precisará estar cadastrado

	Route::get('/', 'ProdutoController@telaProdutoGrade')->name('inicial');	
	Route::get('/logout', 'UserController@logout');	
	Route::get('/tela/produtos/detalhar/{slug}', 'ProdutoController@telaDetalhes')->name('tela_detalhes');	

	Route::middleware(['permissaoCliente'])->group(function(){
		//Todas as rotas aqui dentro, o usuário precisará estar cadastrado e ser cliente (Usuario Cliente)

		//* Endereços *//
		/* Telas */		
		Route::get('/tela/endereco/adicionar', 'EnderecoController@telaAdicionarEndereco')->name('tela_adicionar_endereco');
		Route::get('/tela/endereco/alterar/{id}', 'EnderecoController@telaAlterarEndereco')->name('tela_alterar_endereco');				
		Route::get('/tela/endereco/listar', 'EnderecoController@telaListarEndereco')->name('tela_listar_endereco');

		/* Funções */
		Route::post('/endereco/registrar', 'EnderecoController@addEndereco')->name('registrar_endereco');		
		Route::post('/endereco/atualizar/{id}', 'EnderecoController@updateEndereco')->name('alterar_endereco');		
		Route::get('/endereco/excluir/{id}', 'EnderecoController@deleteEndereco')->name('excluir_endereco');


		//* E-Commerce *//
		/* Telas */		
		Route::get('/tela/carrinho', 'VendaController@telaCarrinho')->name('tela_carrinho');				
		Route::get('/tela/produtos/lista', 'ProdutoController@telaProdutoLista')->name('tela_produtos_lista');
		Route::get('/tela/pedidos', 'VendaController@telaListarVendaEspecifico')->name('tela_meus_pedidos');

		/* Funções */	
		Route::post('/carrinho/adicionar', 'VendaController@addCarrinho')->name('adicionar_carrinho');
		Route::get('/carrinho/remover/{id}', 'VendaController@removerCarrinho')->name('remover_carrinho');
		Route::post('/venda/finalizar', 'VendaController@finalizar')->name('finalizar_venda');
	});

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

		//* Categorias *//
		/* Telas */
		Route::get('/tela/categoria/adicionar', 'CategoriaController@telaAdicionarCategoria')->name('tela_adicionar_categoria');
		Route::get('/tela/categoria/alterar/{id}', 'CategoriaController@telaAlterarCategoria')->name('tela_alterar_categoria');
		Route::get('/tela/categoria/listar', 'CategoriaController@telaListarCategoria')->name('tela_listar_categoria');

		/* Funções */
		Route::post('/categoria/registrar', 'CategoriaController@addCategoria')->name('registrar_categoria');
		Route::post('/categoria/atualizar/{id}', 'CategoriaController@updateCategoria')->name('alterar_categoria');
		Route::get('/categoria/excluir/{id}', 'CategoriaController@deleteCategoria')->name('excluir_categoria');

		//* Produtos *//
		/* Telas */
		Route::get('/tela/produto/adicionar', 'ProdutoController@telaAdicionarProduto')->name('tela_adicionar_produto');
		Route::get('/tela/produto/alterar/{id}', 'ProdutoController@telaAlterarProduto')->name('tela_alterar_produto');
		Route::get('/tela/produto/listar', 'ProdutoController@telaListarProduto')->name('tela_listar_produto');

		/* Funções */
		Route::post('/produto/registrar', 'ProdutoController@addProduto')->name('registrar_produto');
		Route::post('/produto/atualizar/{id}', 'ProdutoController@updateProduto')->name('alterar_produto');
		Route::get('/produto/excluir/{id}', 'ProdutoController@deleteProduto')->name('excluir_produto');

		//* Vendas *//
		/* Telas*/
		Route::get('/tela/venda/listar/geral', 'VendaController@telaListarVendaGeral')->name('tela_listar_venda_geral');

		//* Links *//
		/* Telas */
		Route::get('/tela/link/cadastrar', 'LinkController@telaAdicionarLink')->name('tela_adicionar_link');
		Route::get('/tela/link/alterar/{id}', 'LinkController@telaAlterarLink')->name('tela_alterar_link');
		Route::get('/tela/link/listar', 'LinkController@telaListarLink')->name('tela_listar_link');

		/* Funções */
		Route::post('/link/registrar','LinkController@addLink')->name('registrar_link');
		Route::post('/link/atualizar/{id}', 'LinkController@updateLink')->name('alterar_link');
		Route::get('/link/excluir/{id}', 'LinkController@deleteLink')->name('excluir_link');

		/* Dashboard */
		Route::get('/dashboard', 'AppController@dashboard')->name('dashboard');
	});			
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');