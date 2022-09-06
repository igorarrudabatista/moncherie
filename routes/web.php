<?php

use App\Http\Controllers\{
    CreateController,
    Empresa_ClienteController,
    EmpresaController,
    HomeController,
    PdfController,
    ProdutosController,
    OrcamentoController,
    InfoController,
    UsuariosController,
    EstoqueController,
    PrimoController
};
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    

    Route::get('/', function () {return view('/dashboard'); 
    })->name('dashboard');
    
   // Route::get('/', [HomeController::class, 'home']);




// Route::get('base', function () {
//     return view('base');
// }); 
//Dashboard
Route::get('/',                                   [HomeController::class,     'home']);

// Usuários
Route::get('/usuarios_listar',                    [UsuariosController::class, 'index']);
Route::get('/usuarios',                           [UsuariosController::class, 'create']);
Route::get('/usuarios/edit/{id}',                 [UsuariosController::class, 'edit']);
Route::post('/usuarios',                          [UsuariosController::class, 'store']);
Route::put('/usuarios/update/{id}',               [UsuariosController::class, 'update']);


//Cadastro de Produtos
Route::get('/produtos/produtos',                 [ProdutosController::class,   'produtos']);
Route::get('/produtos/create',                   [ProdutosController::class,   'create']);
Route::get('/produtos/edit/{id}',                [ProdutosController::class,   'edit']);
Route::post('/produtos',                         [ProdutosController::class,   'store']);
Route::put('/produtos/update/{id}',              [ProdutosController::class,   'update']);
Route::delete('/produtos/{id}',                  [ProdutosController::class,   'destroy']);

Route::get('/produtos/export',                   [ProdutosController::class,   'export']);


//Estoque
Route::get('/estoque/form_estoque',              [EstoqueController::class,   'index']);
Route::post('/estoque/{id}',                     [EstoqueController::class,   'estoque']);


//Minha Empresa
Route::get('/minha_empresa/form_empresa',             [EmpresaController::class,    'create']);
Route::post('/minha_empresa',                         [EmpresaController::class,    'store']);
Route::get('/minha_empresa/form_empresa/edit/{id}',   [EmpresaController::class,  'edit']);
Route::put('/minha_empresa/form_empresa/update/{id}', [EmpresaController::class,'update']);


//Empresa Cliente
Route::get('empresa/form_empresa_cliente',        [Empresa_ClienteController::class,   'create' ]);
Route::post('/empresa',                           [Empresa_ClienteController::class,   'store' ]);
Route::get('/empresa/show_clientes',              [Empresa_ClienteController::class,   'show']);
Route::get('/empresa/edit/{id}',                  [Empresa_ClienteController::class,   'edit']);
Route::put('/empresa/update/{id}',                [Empresa_ClienteController::class,   'update']);
Route::delete('/empresa/{id}',                    [Empresa_ClienteController::class,   'destroy']);
Route::get('/empresa/export',                     [Empresa_ClienteController::class,   'export']);


//Orçamentos
Route::get('orcamento/create_orcamento',                        [OrcamentoController::class, 'create']);
Route::post('/orcamento',                                       [OrcamentoController::class, 'store']);
Route::get('/orcamento/show_orcamento',                         [OrcamentoController::class, 'show']);
Route::get('/orcamento/edit/{id}',                              [OrcamentoController::class, 'edit']);
Route::put('/orcamento/update/{id}',                            [OrcamentoController::class, 'update']);
//Route::get('/orcamento/update/status/{id}',        [OrcamentoController::class, 'update_status']);
Route::get('/orcamento/update/status_vendarealizada/{id}',      [OrcamentoController::class, 'update_vendarealizada']);
Route::get('/orcamento/update/status_cancelado/{id}',           [OrcamentoController::class, 'update_cancelado']);
Route::get('/orcamento/update/status_pendente/{id}',            [OrcamentoController::class, 'update_pendente']);
//
Route::delete('/orcamento/{id}',                  [OrcamentoController::class, 'destroy']);
Route::get('/orcamento/modelos/modelo1/{id}',     [OrcamentoController::class, 'modelo1']);
Route::get('/orcamento/modelos/modelo2/{id}',     [OrcamentoController::class, 'modelo2']);
Route::get('/orcamento/modelos/modelo3/{id}',     [OrcamentoController::class, 'modelo3']);
Route::get('/orcamento/modelos/modelo4/{id}',     [OrcamentoController::class, 'modelo4']);
Route::get('/orcamento/modelos/modelo5/{id}',     [OrcamentoController::class, 'modelo5']);
Route::get('/orcamento/modelos/modelo6/{id}',     [OrcamentoController::class, 'modelo6']);

Route::get('/orcamento/export',                   [OrcamentoController::class,   'export']);


// Informações
Route::get('/informacoes',                        [InfoController::class, 'home']);

//Gerar PDF
Route::get('/orcamento/pdf',                      [OrcamentoController::class,  'geraPdf']); //gerar o PDF de orçamentos

//testeeee
Route::get('/primo/index',                    [PrimoController::class,   'index']);
Route::get('/primo/create',                   [PrimoController::class,   'create']);
Route::get('/primo/edit/{id}',                [PrimoController::class,   'edit']);
Route::post('/primo',                         [PrimoController::class,   'store']);
Route::put('/primo/update/{id}',              [PrimoController::class,   'update']);
Route::delete('/primo/{id}',                  [PrimoController::class,   'destroy']);

});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
