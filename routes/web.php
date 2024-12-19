<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardHome;
use App\Http\Controllers\LivCard;
use Inertia\Inertia;

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


//Rotas Painel ADM
Route::get('/home', [DashboardHome::class, 'home'])->name('home');
Route::get('/dashboard/produtos', [DashboardHome::class, 'produtos'])->name('produtos');
Route::get('/dashboard/usuarios', [DashboardHome::class, 'usuarios'])->name('usuarios');
Route::get('/dashboard/transacoes', [DashboardHome::class, 'transacoes'])->name('transacoes');
Route::get('/dashboard/add/credito/form/transacao', [DashboardHome::class, 'formTransacaoCredito'])->name('add-credito-transacao');
Route::get('/dashboard/form/transacao', [DashboardHome::class, 'formTransacao'])->name('form-transacao');
Route::get('/dashboard/form/produto', [DashboardHome::class, 'formProduto'])->name('form-produto');
Route::post('/dashboard/cad/produto', [DashboardHome::class, 'cadProduto'])->name('cad-produto');
Route::post('/dashboard/cad/transacao', [DashboardHome::class, 'cadTransacao'])->name('cad-transacao');
Route::post('/dashboard/cad/transacao/credito', [DashboardHome::class, 'cadTransacaoCredito'])->name('cad-transacao-credito');
Route::get('/dashboard/info/usuario/{id}', [DashboardHome::class, 'infoUsuario'])->name('info-usuario');
Route::get('/dashboard/form/usuario', [DashboardHome::class, 'formUsuario'])->name('form-usuario');
Route::post('/dashboard/cad/usuario', [DashboardHome::class, 'cadUsuario'])->name('cad-usuario');

//Rotas Painel Usuário LivCard
Route::get('/livcard/home', [LivCard::class, 'home'])->name('livcard-home');
Route::get('/livcard/produtos', [LivCard::class, 'produtos'])->name('livcard-produtos');
Route::get('/livcard/produtos/destroy/{id}', [LivCard::class, 'produtosDestroy'])->name('livcard-produtos-destroy');
Route::get('/livcard/minhas/transacoes', [LivCard::class, 'transacoes'])->name('livcard-transacoes');
Route::get('/livcard/credito', [LivCard::class, 'credito'])->name('livcard-credito');
Route::post('/livcard/adiciona/credito', [LivCard::class, 'Adicionarcredito'])->name('livcard-adicionar-credito');
Route::get('/logout', [LivCard::class, 'logout'])->name('logout');
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        
        $user = Auth::user();  

        if ($user->power == 1) {
            return redirect()->route('home'); 
        } elseif ($user->power == 0) {
            return redirect()->route('livcard-home');  
        }
    })->name('dashboard');
});
