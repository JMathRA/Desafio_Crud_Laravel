<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Cliente;
use Illuminate\Http\Client\Request as ClientRequest;

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

//enviar informações para o servidor
Route::post('/cadastrar-cliente', function (Request $informacoes) {
    Cliente::create([
        'nome'=> $informacoes->nome_cliente,
        'telefone'=>$informacoes->telefone_cliente,
        'endereco'=>$informacoes->endereco_cliente,
        'data'=>$informacoes->data_cliente,
        'cpf'=>$informacoes->cpf_cliente
    ]);
    echo "Cliente cadastrado com sucesso";
});

// buscar informação no banco de dados
Route::get('/mostrar-cliente/{id_do_cliente}', function ($id_do_cliente) {
    //findOrFail -> mostra um erro 404 caso o id nao exista no banco de dados
    $cliente = Cliente::findOrFail($id_do_cliente);
    echo $cliente->nome;
    echo "<br />";
    echo $cliente->telefone;
    echo "<br />";
    echo $cliente->endereco;
    echo "<br />";
    echo $cliente->data;
    echo "<br />";
    echo $cliente->cpf;

});

//editar cadastro do banco de dados
Route::get('/editar-cliente/{id_do_cliente}', function ($id_do_cliente) {
    //findOrFail -> mostra um erro 404 caso o id nao exista no banco de dados
    $cliente = Cliente::findOrFail($id_do_cliente);
    return view('editar_cliente', ['cliente' => $cliente]);
});

//enviar e atualizar registro no banco de dados
Route::put('/atualizar-cliente/{id_do_cliente}', function (Request $informacoes, $id_do_cliente) {
    //findOrFail -> mostra um erro 404 caso o id nao exista no banco de dados
    $cliente = Cliente::findOrFail($id_do_cliente);
    $cliente->nome = $informacoes->nome_cliente;
    $cliente->telefone = $informacoes->telefone_cliente;
    $cliente->endereco = $informacoes->endereco_cliente;
    $cliente->data = $informacoes->data_cliente;
    $cliente->cpf = $informacoes->cpf_cliente;

    $cliente->save();

    echo "Candidato atualizado com sucesso";

});

//excluir registro do banco de dados
Route::get('/excluir-cliente/{id_do_cliente}', function ($id_do_cliente) {
    //findOrFail -> mostra um erro 404 caso o id nao exista no banco de dados
    $cliente = Cliente::findOrFail($id_do_cliente);
    //funcao que deleta candidado selecionado pelo id
    $cliente->delete();
    echo "Cliente excluido com sucesso";

});
