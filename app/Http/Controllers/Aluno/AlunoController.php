<?php

namespace App\Http\Controllers\Aluno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Responsavel;

/**
 * 
 * @author Juan Soares
 */
class AlunoController extends Controller {
    
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
        $alunos = Aluno::all();
        return view('aluno.index', compact('alunos'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        $disciplinas = Disciplina::where('is_ativa', true)->get();
        return view('aluno.cadastrar', compact('disciplinas'));
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $aluno = Aluno::findOrFail($id);
        $disciplinas = Disciplina::where('is_ativa', true)->get();
        return view('aluno.editar', compact('aluno', 'disciplinas'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function relatorio() {
        return view('aluno.relatorio');
    }

    /**
     * 
     * @return App\Models\Aluno
     */
    public function getAlunos($search) {
        $alunos = Aluno::select(['alunos.id', 'alunos.matricula', 'alunos.matricula', 'pessoas.nome', 'pessoas.cpf', 'pessoas.telefone', 'pessoas.celular', 'pessoas.email'])
                        ->join('pessoas', 'pessoas.id', '=', 'alunos.pessoa_id')
                        ->where('pessoas.nome', 'like', '%'.$search.'%')
                        ->get();

        return json_encode($alunos);
    }
    
    /**
     * 
     * @return App\Models\Aluno
     */
    public function getResponsaveis($search) {
        $responsaveis = Responsavel::join('pessoas', 'pessoas.id', '=', 'responsavels.pessoa_id')
                            ->where('pessoas.nome', 'like', '%'.$search.'%')
                            ->get();
    
        return json_encode($responsaveis);
    }
    
    /**
     * 
     * @* @param Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        return $this->index();
    }
    
    public function teste(Request $request) {
        $request->validate([
            'cpf' => 'required|unique:pessoas',
            'nome' => 'required|max:150',
            'email' => 'required|max:150|email',
            'data_nascimento' => 'required',
            'sexo' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
            'cep' => 'required',
            'celular' => 'required',
            'responsaveisAluno' => 'required|json'
        ]);
 
        $responsaveis = json_decode($request->responsaveisAluno);

        foreach ($responsaveis as $responsavel) {
            dd($responsavel->responsavel);
        }
        
    }
}
