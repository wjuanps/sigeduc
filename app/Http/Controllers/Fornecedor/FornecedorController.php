<?php

namespace App\Http\Controllers\Fornecedor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Fornecedor;
use App\Models\Endereco;

/**
 * 
 * @author Juan Soares
 */
class FornecedorController extends Controller {
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the index of the teacher's module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $fornecedores = Fornecedor::all();
        return view('fornecedor.index', compact('fornecedores'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        return view('fornecedor.cadastrar');
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedor.editar', compact('fornecedor'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function relatorio() {
        return view('fornecedor.relatorio');
    }

    /**
     * 
     * @* @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'cnpj' => 'required|unique:fornecedors',
            'nome_fantasia' => 'required|max:150',
            'razao_social' => 'required',
            'tipo' => 'required',
            'segmento' => 'required',
            'data_fundacao' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
            'cep' => 'required',
            'celular' => 'required'
        ]);

        $dataFundacao = explode('/', $request->data_fundacao);
        $dataFundacao = implode('-', array_reverse($dataFundacao));

        $endereco = Endereco::create([
            'rua' => $request->rua,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'cidade' => $request->cidade,
            'complemento' => $request->complemento,
            'uf' => $request->uf
        ]);

        Fornecedor::create([
            'cnpj' => $request->cnpj,
            'endereco_id' => $endereco->id,
            'celular' => $request->celular,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'data_fundacao' => $dataFundacao,
            'inscricao_estadual' => $request->inscricao_estadual,
            'nome_fantasia' => $request->nome_fantasia,
            'razao_social' => $request->razao_social,
            'segmento' => $request->segmento,
            'site' => $request->site,
            'logo' => $request->logo,
            'tipo' => $request->tipo
        ]);

        return $this->index();
    }

    public function teste(Request $request) {
        dd($request->all());
    }
}
