<?php

namespace App\Http\Controllers;

use App\Models\Empresa_Cliente;
use App\Exports\ClienteExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;


class Empresa_ClienteController extends Controller
{
    public function create (){

        return view ('empresa.form_empresa_cliente');

    }

    public function export () {
        
        $criar_empresa = Empresa_Cliente::all();

        return Excel::download(new ClienteExport, 'clientes.xlsx');
      //  return Excel::download(new Empresa_Cliente, 'users.xlsx');
    }

    public function store (Request $request) {

        toast('Cliente criado com sucesso!','success');


        $criar_empresa_cliente =  new Empresa_cliente();

        $criar_empresa_cliente -> Nome_Empresa       = $request->Nome_Empresa;
        $criar_empresa_cliente -> Cnpj               = $request->Cnpj;
        $criar_empresa_cliente -> Email              = $request->Email;
        $criar_empresa_cliente -> Telefone           = $request->Telefone;
        $criar_empresa_cliente -> Site               = $request->Site;
        $criar_empresa_cliente -> Cidade             = $request->Cidade;
        $criar_empresa_cliente -> Endereco           = $request->Endereco;
        $criar_empresa_cliente -> Estado             = $request->Estado;
        $criar_empresa_cliente -> Cpf                = $request->Cpf;
        $criar_empresa_cliente -> Numero             = $request->Numero;
        $criar_empresa_cliente -> Cep                = $request->Cep;
        $criar_empresa_cliente -> Bairro             = $request->Bairro;
        $criar_empresa_cliente -> Instagram          = $request->Instagram;
        $criar_empresa_cliente -> Facebook           = $request->Facebook;




                // Imagem do produto upload
        if ($request->hasFile('image')&& $request->file('image')->isValid()){

            $requestImage = $request -> image;

            $extension = $requestImage-> extension();

            $imageName = md5($requestImage -> getClientOriginalName() . strtotime("now")) . "." . $extension;

            $request -> image->move(public_path('img/empresa'), $imageName);

            $criar_empresa_cliente -> image = $imageName;

        }

        $criar_empresa_cliente ->save();

        $criar_empresa = Empresa_cliente::all();

        return redirect('/empresa/show_clientes');
    }

    public function show() {
        
        $criar_empresa = Empresa_Cliente::all();

        $search = request('search');

        if($search) {
            $criar_empresa = Empresa_Cliente::where ([['Nome_Empresa', 'like', '%'.$search. '%' ]])->get();

             } else {
                $criar_empresa = Empresa_Cliente::all();
            }
        

        return view('empresa.show_clientes', ['criar_empresa'=> $criar_empresa, 'search' => $search]);

    }

    public function edit ($id){


        $editar_empresa = Empresa_cliente::findOrFail($id);

        return view ('empresa.edit', ['editar_empresa'=> $editar_empresa]);



        // $editar_empresa = Empresa_cliente::findOrFail($id);

        // $titulo = "Edita Cliente";
        // $cliente = Empresa_cliente::find($id);

        // return view ('empresa.edit', ['editar_empresa'=> $editar_empresa, compact('titulo', 'cliente')]);


    }

    public function update (Request $request){
        
        
        $data = $request->all();

        
        // Imagem do produto upload
        if ($request->hasFile('image')&& $request->file('image')->isValid()){
            
            $requestImage = $request -> image;
            
            $extension = $requestImage-> extension();
            
            $imageName = md5($requestImage -> getClientOriginalName() . strtotime("now")) . "." . $extension;
            
            $request -> image->move(public_path('img/empresa'), $imageName);
            
            $data['image'] = $imageName;
            
        }
        toast('Cliente editado com sucesso!','success');

     Empresa_cliente::findOrFail($request->id) -> update ($data);
     return redirect('/empresa/show_clientes');




    }



    public function destroy($id){
        
        toast('Cliente deletado com sucesso!','error');

        Empresa_cliente::findOrFail($id) -> delete();
        return redirect('/empresa/show_clientes');
    }

}
