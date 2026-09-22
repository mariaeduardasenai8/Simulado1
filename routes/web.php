<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstoqueController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
Route::get('/produto/novo', [EstoqueController::class, 'create'])->name('produto.create');
Route::post('/produto/salvar', [EstoqueController::class, 'store'])->name('produto.store');
Route::post('/estoque/movimentar', [EstoqueController::class, 'movimentar'])->name('estoque.movimentar');
Route::get('/estoque/pedido', function () {return view('estoque.pedido');})->name('estoque.pedido');
Route::post('/estoque/pedido/salvar', [EstoqueController::class, 'salvarPedidoCompra'])->name('estoque.pedido.salvar');

