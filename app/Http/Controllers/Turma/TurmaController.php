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
    public function getTurmasAluno($filter) {
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
     */
    public function getTurmasProfessor($idDisciplina, $idProfessor) {
        $turmas = Disciplina::join('professor_has_turmas', 'disciplinas.id', '=', 'professor_has_turmas.disciplina_id')
                                ->join('turmas', 'turmas.id', 'professor_has_turmas.turma_id')
                                ->join('professors', 'professors.id', 'professor_has_turmas.professor_id')
                                ->where([
                                    ['disciplinas.id' ,'=', $idDisciplina],
                                    ['professors.id' ,'=', $idProfessor]
                                ])
                                ->select('turmas.id', 'turmas.turma')
                                ->get();
        return json_encode($turmas);
    }

    /**
     * 
     * @* @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        $turma = new Turma;
        $turma->salvarTurma($request);
        return $this->index();
    }

    public function teste(Request $request) {
        dd($request->all());
    }
}
