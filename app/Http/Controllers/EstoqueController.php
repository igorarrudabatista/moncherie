<?php

namespace App\Http\Controllers;

use App\Models\Empresa_cliente;
use Illuminate\Http\Request;
use App\Models\Orcamento;
use App\Models\Empresa;
use App\Models\Produto;
use App\Models\Estoque;
use Symfony\Component\Console\Input\Input;





class EstoqueController extends Controller {

    public function index() {

        $produtos = Produto::all();
        $search = request('search');

       if($search) {
           $produtos = Produto::where ([['Nome_Produto', 'like', '%'.$search. '%' ]])->get();

            } else {
               $produtos = Produto::all();
           }

        return view('estoque.form_estoque', ['produtos'=> $produtos, 'search' => $search]);


    }

    public function estoque (Request $request) {

        
      //  $produtos = Produto::all();
        //    $stock = $request->all();
       $produtos =  new Produto;
       $produtos -> Quantidade_Produto = $request->Quantidade_Produto;
    // $produtos->Quantidade_Produto->id;
        $action      = request()->input('action', 'add') == 'add' ? 'add' : 'remove';
        $stockAmount = request()->input('stock', 1);
        $sign        = $action == 'add' ? '+' : '-';

        if ($stockAmount < 1) {
            return view('estoque.form_estoque')->with([
                'error' => 'No item was added/removed. Amount must be greater than 1.',
            ]);
        }

        Produto::create([
            'stock'    => $sign . $stockAmount,
            'produtos' => $produtos->Quantidade_Produto,
          //  'team_id'  => $produtos->id,
            'user_id'  => auth()->user()->id,
        ]);

        if ($action == 'add') {
            $produtos->increment('Quantidade_Produto', $stockAmount);
            $status = $stockAmount . ' item(-s) was added to stock.';
        }

        if ($action == 'remove') {
            if ($produtos->Quantidade_Produto - $stockAmount < 0) {
                return view('estoque.form_estoque', ['produtos'=> $produtos])->with([
                    'error' => 'Not enough items in stock.',
                ]);
            }

            $produtos->decrement('Quantidade_Produto', $stockAmount);
            $status = $stockAmount . ' item(-s) was removed from stock.';
        }

        return view('estoque.form_estoque', ['produtos'=> $produtos])->with([
            'status' => $status,
        ]);
    
    

    }
 
  
   


}
