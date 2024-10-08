<?php

namespace App\Http\Controllers;

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

Route::namespace('App\Http\Controllers')
->group(function () {
    Route::get('/', 'HomeController@Home')->name('home');

    Route::prefix('cadastro')->group(function () {
        Route::get('/', 'UsuarioController@formulario')->name('cadastro');
        Route::post('/', 'UsuarioController@criar')->name('cadastro.novo');
        Route::get('/sucesso', function ($nome) {
            return view('cadastro.sucesso', ['nome' => $nome]);
        })->name('cadastro.sucesso');
    });

    Route::middleware('auth:web')->group(function () {
        Route::resource('servico', 'ServicoController')
        ->only(['index', 'show']);

        Route::group(['prefix' => 'usuario'], function () {
            Route::get('/perfil', 'UsuarioController@obterDadosPerfil');

            Route::resource('servico', 'ServicoController')
            ->only(['create', 'store', 'edit', 'update']);

            Route::prefix('servico')->group(function () {
                Route::get('/{servico}/{status}', 'ServicoController@atualizarStatusCliente')
                ->name('cliente.servico.update.status');
            });
        });

        Route::prefix('fotografo')->group(function () {
            Route::get('portfolio', 'PortfolioController@index')->name('fotografo.portfolio.index');
            Route::get('portfolio/editar', 'PortfolioController@edit')->name('fotografo.portfolio.edit');

            Route::patch('/servico/{servico}/{status}', 'ServicoController@atualizarStatusFotografo')
            ->name('fotografo.servico.update.status');
        });
    });
    
    Route::get('fotografo', 'FotografoController@index')->name('fotografo.index');
    Route::get('fotografo/{fotografo}', 'FotografoController@show')->name('fotografo.show');

    Route::get('/signin', 'LoginController@signin')->name('login');
    Route::get('/signout', 'LoginController@signout')->name('deslogar');
    Route::post('/signin/authenticate', 'LoginController@autenticarUsuario')->name('login.autenticar');
});
