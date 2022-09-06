<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orcamento;
use App\Models\Empresa;
use App\Models\Empresa_Cliente;
use App\Models\Produto;



class HomeController extends Controller
{
  public function home() {

    $empresa = Empresa::all();
    $orcamento = Orcamento::all();
    $empresa_cliente = Empresa_Cliente::all();
    $produtos = Produto::all();
    $aprovado = Orcamento::whereIn('Status', ['Aprovado'])->get();
    $pendente = Orcamento::whereIn('Status', ['Pendente'])->get();
    $cancelado =Orcamento::whereIn('Status', ['Cancelado'])->get();

    return view('dashboard.home', [
                'empresa'=> $empresa, 
                'orcamento' => $orcamento,
                'empresa_cliente' => $empresa_cliente,
                'produtos' => $produtos,
                'aprovado' => $aprovado,
                'pendente' => $pendente,
                'cancelado'=> $cancelado
              ]);

//    return view('dashboard.home');
}

public function pendente()
{
    $sql = DB::table('orcamentos')->where('Status')->orWhere('Pendente')->get();
    return view('index',['results'=>$sql]);
}

public function delhi_property()
{
  
}


}