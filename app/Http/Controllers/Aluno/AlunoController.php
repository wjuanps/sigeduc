<?php

namespace App\Http\Controllers\Aluno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Responsavel;
use App\Models\Turma;

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
        try {
            $aluno = Aluno::findOrFail($id);
            $disciplinas = Disciplina::where('is_ativa', true)->get();
            return view('aluno.editar', compact('aluno', 'disciplinas'));
        } catch (HttpException $th) {
            dd($th);
        }
    }
    
    protected $turma;

    /**
     * 
     * @* @param Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editarTurmas(Request $request) {
        
        $aluno = Aluno::findOrFail($request->id_aluno);

        if (isset($request->turmas)) {
            $aluno->salvarTurma($request);
            $aluno = Aluno::findOrFail($request->id_aluno);
        }

        $alunoTurmas = array();
        foreach ($aluno->turmas as $turma) {
            array_push($alunoTurmas, $turma);
        }
        
        $turmas = Turma::where([
            ['modalidade', '=', $request->modalidade],
            ['turno', '=', $request->turno],
            ['serie', '=', $request->serie]
        ])->get();
            
        $turma = null;
        if (isset($request->id_turma)) {
            $turma = Turma::findOrFail($request->id_turma);
            $turma->is_repetente = (isset($request->is_repetente));
            array_unshift($alunoTurmas, $turma);
        }

        return view('aluno.editar-turmas', compact('aluno', 'turmas', 'alunoTurmas'));
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
        $turma = Turma::find($request->id_turma);
        dd($turma);
    }
}
