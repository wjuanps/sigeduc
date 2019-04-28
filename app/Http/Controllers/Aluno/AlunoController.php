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
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $aluno = Aluno::findOrFail($id);
        $disciplinas = Disciplina::where('is_ativa', true)->get();
        return view('aluno.editar', compact('aluno', 'disciplinas'));
    }

    /**
     * 
     * @* @param int $id
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editarTurmas(int $id) {
        $aluno = Aluno::findOrFail($id);
        return view('aluno.editar-turmas', compact('aluno'));
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
     * @* @param String $search
     * 
     * @return App\Models\Aluno
     */
    public function getAlunos($search) {
        $alunos = Aluno::join('pessoas', 'pessoas.id', '=', 'alunos.pessoa_id')
                        ->where('pessoas.nome', 'like', '%'.$search.'%')
                        ->select([
                            'alunos.id', 'alunos.matricula', 'alunos.matricula', 'pessoas.nome', 
                            'pessoas.cpf', 'pessoas.telefone', 'pessoas.celular', 'pessoas.email'
                        ])
                        ->get();

        return json_encode($alunos);
    }
    
    /**
     * 
     * @* @param String $search
     * 
     * @return App\Models\Aluno
     */
    public function getResponsaveis($search) {
        $responsaveis = Responsavel::join('pessoas', 'pessoas.id', '=', 'responsavels.pessoa_id')
                            ->where('pessoas.nome', 'like', '%'.$search.'%')
                            ->select([
                                'responsavels.id', 'pessoas.nome', 'pessoas.telefone', 
                                'pessoas.celular', 'pessoas.email', 'pessoas.cpf'
                            ])
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
        $responsaveis = json_decode($request->responsaveisAluno);
        if (!isset($responsaveis) || count($responsaveis) <= 0) {
            return redirect()
                        ->back()
                        ->withErrors(['Responsável' => 'Informe ao menos um responsável']);
        }

        $aluno = new Aluno;
        $aluno = $aluno->salvarAluno($request);

        if ($aluno instanceof Aluno) {
            return $this->index();
        }
    }
    
    /**
     * 
     */
    public function teste(Request $request) {
    }
}
