<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Formacao;
use App\Models\ProfessorHasDisciplina;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\Turma;

/**
 * 
 * @author Juan Soares
 */
class ProfessorController extends Controller {
    
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
        $professores = Professor::all();
        return view('professor.index', compact('professores'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        $disciplinas = Disciplina::where('is_ativa', true)->get();
        return view('professor.cadastrar', compact('disciplinas'));
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $professor = Professor::findOrFail($id);
        $disciplinasProfessor = [];
        foreach ($professor->disciplinas as $disciplina) {
            array_push($disciplinasProfessor, $disciplina->disciplina);
        }
        $disciplinas = Disciplina::where('is_ativa', true)->get();
        return view('professor.editar', compact('professor', 'disciplinas', 'disciplinasProfessor'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function relatorio() {
        return view('professor.relatorio');
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function diarioClasse() {
        $professores = Professor::all();
        return view('professor.diario-de-classe', compact('professores'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function gerarDiarioClasse($idProfessor, $idTurma, $idDisciplina) {
        $idProfessor = (is_int($idProfessor)) ? $idProfessor : intval($idProfessor);
        $idTurma = (is_int($idTurma)) ? $idTurma : intval($idTurma);
        $idDisciplina = (is_int($idDisciplina)) ? $idDisciplina : intval($idDisciplina);

        $turma = Turma::join('professor_has_turmas', 'turmas.id', '=', 'professor_has_turmas.turma_id')
                        ->join('professors', 'professors.id', '=', 'professor_has_turmas.professor_id')
                        ->join('disciplinas', 'disciplinas.id' ,'=', 'professor_has_turmas.disciplina_id')
                        ->join('pessoas as p1', 'p1.id', '=', 'professors.pessoa_id')
                        ->join('aluno_has_turmas', 'aluno_has_turmas.turma_id', '=', 'turmas.id')
                        ->join('alunos', 'alunos.id', '=', 'aluno_has_turmas.aluno_id')
                        ->join('pessoas as p2', 'p2.id', '=', 'alunos.pessoa_id')
                        ->where([
                            ['turmas.id',      '=', $idTurma],
                            ['professors.id',  '=', $idProfessor],
                            ['disciplinas.id', '=', $idDisciplina]
                        ])
                        ->select([
                            'turmas.turma as turma', 'turmas.modalidade as modalidade', 
                            'p1.nome as docente', 'disciplinas.disciplina as disciplina',
                            'alunos.matricula as matricula', 'p2.nome as discente'
                        ])
                        ->get();

        return response()->json($turma);
    }

    /**
     * 
     */
    public function getProfessores($idDisciplina) {
        $idDisciplina = is_int($idDisciplina) ? $idDisciplina : (int) $idDisciplina;
        $professores = Disciplina::find($idDisciplina)->professores;
        $pessoas = [];
        foreach ($professores as $professor) {
            array_push($pessoas, array('id' => $professor->id, 'nome' => $professor->pessoa->nome));
        }
        return json_encode($pessoas);
    }

    /**
     * 
     * @* @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        $professor = new Professor;
        $professor->salvarProfessor($request);

        return $this->index();
    }

    public function teste(Request $request) {
        
    }
}
