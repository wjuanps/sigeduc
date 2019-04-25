<?php

namespace App\Http\Controllers\Turma;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\ProfessorHasTurma;
use App\Models\AlunoHasTurma;

/**
 * 
 * @author Juan Soares
 */
class TurmaController extends Controller {
    
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
        $turmas = Turma::all();
        return view('turma.index', compact('turmas'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        $disciplinas = Disciplina::where('is_ativa', true)->get();
        return view('turma.cadastrar', compact('disciplinas'));
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $disciplinas = Disciplina::where('is_ativa', true)->get();
        $turma = Turma::findOrFail($id);
        return view('turma.editar', compact('disciplinas', 'turma'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function relatorio() {
        return view('turma.relatorio');
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTurmas($filter) {
        $filter = json_decode($filter);
        $turmas = Turma::where([
                            ['modalidade', '=', $filter->modalidade],
                            ['turno', '=', $filter->turno],
                            ['serie', '=', $filter->serie]
                        ])->get();
        return json_encode($turmas);
    }

    
    /**
     * 
     * @* @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'turma' => 'required|unique:turmas',
            'serie' => 'required|max:150',
            'turno' => 'required|max:150',
            'modalidade' => 'required',
            'disciplinas' => 'required|json',
            'alunos' => 'required|json|min:1'
        ]);

        $turma = Turma::create([
            'escola_id' => 1,
            'turma' => $request->turma,
            'serie' => $request->serie,
            'turno' => $request->turno,
            'modalidade' => $request->modalidade,
            'descriao_turma' => $request->descriao_turma,
            'descricao_serie' => $request->descricao_serie,
            'desativada_em' => date_create()
        ]);
        
        $disciplinas = json_decode($request->disciplinas);
        if (isset($disciplinas) && count($disciplinas) > 0) {
            foreach ($disciplinas as $disciplina) {
                ProfessorHasTurma::create([
                    'professor_id' => $disciplina->idProfessor,
                    'turma_id' => $turma->id,
                    'disciplina_id' => $disciplina->idDisciplina
                ]);
            }
        }
        
        $alunos = json_decode($request->alunos);
        if (isset($alunos) && count($alunos) > 0) {
            foreach ($alunos as $aluno) {
                AlunoHasTurma::create([
                    'turma_id' => $turma->id,
                    'aluno_id' => $aluno->id,
                    'ano' => date_format(date_create(), 'Y'),
                    'is_repetente' => 0
                ]);
            }
        }

        return $this->index();
        
    }

    public function teste(Request $request) {
        dd($request->all());
    }
}
