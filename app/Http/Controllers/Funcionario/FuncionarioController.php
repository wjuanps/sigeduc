<?php

namespace App\Http\Controllers\Funcionario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Funcionario;
use App\Models\CargoFuncao;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\FuncionarioHasCargo;

/**
 * 
 * @author Juan Soares
 */
class FuncionarioController extends Controller {
    
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
        $funcionarios = Funcionario::all();
        return view('funcionario.index', compact('funcionarios'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        $cargos = CargoFuncao::all();
        return view('funcionario.cadastrar', compact('cargos'));
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $funcionario = Funcionario::findOrFail($id);
        $cargos = CargoFuncao::all();
        return view('funcionario.editar', compact('funcionario', 'cargos'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function relatorio() {
        return view('funcionario.relatorio');
    }

    /**
     * 
     * @* @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'cpf' => 'required|unique:pessoas',
            'nome' => 'required|max:150',
            'email' => 'required|max:150|email',
            'data_nascimento' => 'required',
            'sexo' => 'required',
            'numero_ctps' => 'required',
            'numero_pis' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
            'cep' => 'required',
            'celular' => 'required'
        ]);
        
        $dataNascimento = explode('/', $request->data_nascimento);
        $dataNascimento = implode('-', array_reverse($dataNascimento));
        $dataEmissaoCarteira = explode('/', $request->data_emissao_carteira);
        $dataEmissaoCarteira = implode('-', array_reverse($dataEmissaoCarteira));

        $endereco = Endereco::create([
            'rua' => $request->rua,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'cidade' => $request->cidade,
            'complemento' => $request->complemento,
            'uf' => $request->uf
        ]);

        $pessoa = Pessoa::create([
            'endereco_id' => $endereco->id,
            'celular' => $request->celular,
            'cpf' => $request->cpf,
            'data_nascimento' => $dataNascimento,
            'email' => $request->email,
            'rg' => $request->rg,
            'foto' => $request->foto,
            'nacionalidade' => $request->nacionalidade,
            'naturalidade' => $request->naturalidade,
            'nome' => $request->nome,
            'sexo' => $request->sexo,
            'telefone' => $request->telefone,
            'naturalidade_uf' => $request->naturalidade_uf
        ]);

        $funcionario = Funcionario::create([
            'pessoa_id' => $pessoa->id,
            'data_emissao_carteira' => $dataEmissaoCarteira,
            'qtd_dependentes' => $request->qtd_dependentes,
            'escolaridade' => $request->escolaridade,
            'numero_ctps' => $request->numero_ctps,
            'numero_pis' => $request->numero_pis,
            'serie_ctps' => $request->serie_ctps
        ]);

        $cargos = json_decode($request->funcionarioCargos);
        foreach ($cargos as $cargo) {
            FuncionarioHasCargo::create([
                'funcionario_id' => $funcionario->id,
                'cargo_id' => $cargo->id,
                'is_cargo_atual' => $cargo->cargoAtual,
                'carga_horaria' => $cargo->cargaHoraria
            ]);
        }

        return $this->index();
    }

    public function teste(Request $request) {
        dd($request->all());
    }
}
