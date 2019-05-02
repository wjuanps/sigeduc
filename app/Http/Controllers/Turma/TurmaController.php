<?php

namespace App\Http\Controllers\Turma;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Turma;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\AlunoHasTurma;
use App\Models\ProfessorHasTurma;

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
     * @* @param Request $request
     */
    public function adicionarAlunos(Request $request) {
        
        $turma = Turma::findOrFail($request->id_turma);

        if (isset($request->alunos)) {
            $turma->salvarAluno($request);
            $turma = Turma::findOrFail($request->id_turma);
        }

        $alunos = null;
        if (isset($request->nomeAluno)) {
            $alunos 
                = Aluno::join('pessoas', 'pessoas.id', '=', 'alunos.pessoa_id')
                    ->where('pessoas.nome', 'like', '%'.$request->nomeAluno.'%')
                    ->select([
                        'alunos.id', 'alunos.matricula', 'alunos.matricula', 'pessoas.nome', 
                        'pessoas.cpf', 'pessoas.telefone', 'pessoas.celular', 'pessoas.email'
                ])->get();
        }

        $turmaAlunos = array();
        foreach ($turma->alunos as $aluno) {
            array_push($turmaAlunos, $aluno);
        }

        $aluno = null;
        if (isset($request->id_aluno)) {
            $aluno = Aluno::findOrFail($request->id_aluno);
            $aluno->is_repetente = isset($request->is_repetente);
            array_unshift($turmaAlunos, $aluno);
        }
        
        return view('turma.adicionar-alunos', compact('turma', 'alunos', 'turmaAlunos'));
    }

    /**
     * 
     * @* @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function gradeDeProfessores(Request $request) {
        $turma = Turma::findOrFail($request->id_turma);
        $disciplinas = Disciplina::where('is_ativa', true)->get();

        if (isset($request->salvarProfessores)) {
            $turma->salvarProfessor($request);
            $turma = Turma::findOrFail($request->id_turma);
        }

        $professoresTemp = Professor::join('professor_has_turmas', 'professors.id', '=', 'professor_has_turmas.professor_id')
                                    ->join('turmas', 'turmas.id', '=', 'professor_has_turmas.turma_id')
                                    ->join('disciplinas', 'disciplinas.id', '=', 'professor_has_turmas.disciplina_id')
                                    ->join('pessoas', 'pessoas.id', '=', 'professors.pessoa_id')
                                    ->where([['turmas.id' ,'=', $request->id_turma]])
                                    ->select([
                                        'disciplinas.id as id_disciplina', 'disciplinas.disciplina as nome_disciplina', 
                                        'pessoas.nome as nome_professor', 'professors.id as id_professor'
                                    ])
                                    ->get();

        $professores = array();
        foreach ($professoresTemp as $professor) {
            array_push($professores, $professor);
        }
                                        
        $professorDisciplinas = array();

        $disciplina_ids = array();
        $professor_ids = array();
        if (isset($request->id_disciplina) && isset($request->id_professor)) {
            
            if (!isset($request->professor_ids) && !isset($request->disciplina_ids)) {
                array_push($professor_ids, $request->id_professor);
                array_push($disciplina_ids, $request->id_disciplina);
            } else {
                array_push($professor_ids, $request->id_professor);
                foreach ($request->professor_ids as $id) {
                    array_push($professor_ids, $id);                    
                }
                array_push($disciplina_ids, $request->id_disciplina);
                foreach ($request->disciplina_ids as $id) {
                    array_push($disciplina_ids, $id);                   
                }
            }

            if (isset($request->excluirProfessor)) {
                $discTemp = array_filter($disciplina_ids, function ($value) use (&$request) {
                    return $request->id_disciplina != $value;
                });
                $profesTemp = array_filter($professor_ids, function ($value) use (&$request) {
                    return $request->id_professor != $value;
                });
                
                $professor_ids = $disciplina_ids = array();

                foreach ($discTemp as $value) {
                    array_push($disciplina_ids, $value);
                }

                foreach ($profesTemp as $value) {
                    array_push($professor_ids, $value);
                }
            }

            for ($i = 0; $i < count($disciplina_ids) && $i < count($professor_ids); $i++) { 
                $professorDisciplinas = Disciplina::join('professor_has_disciplinas', 'disciplinas.id', '=', 'professor_has_disciplinas.disciplina_id')
                                ->join('professors', 'professors.id', 'professor_has_disciplinas.professor_id')
                                ->join('pessoas', 'pessoas.id', '=', 'professors.pessoa_id')
                                ->where([
                                    ['disciplinas.id' ,'=', $disciplina_ids[$i]],
                                    ['professors.id' ,'=', $professor_ids[$i]]
                                ])
                                ->select([
                                    'disciplinas.id as id_disciplina', 'disciplinas.disciplina as nome_disciplina', 
                                    'pessoas.nome as nome_professor', 'professors.id as id_professor'
                                ])
                                ->get();
                
                foreach ($professorDisciplinas as $professorDisciplina) {
                    $professorDisciplina->novoProfessor = true;
                    array_unshift($professores, $professorDisciplina);
                }
            }
        }

        $professores = array_unique($professores);

        return view('turma.grade-de-professores', compact('turma', 'disciplinas', 'professores', 'disciplina_ids', 'professor_ids'));
    }

    /**
     * 
     * @* @param string $nomeTurma
     * 
     * @return JSON
     */
    public function nomeTurma($nomeTurma) {
        $i = 0;
        do {
            $nomeTurmaTemp = $nomeTurma.(++$i);
            $turma = Turma::where('turmas.nome_turma', '=', $nomeTurmaTemp)->first();
        } while (isset($turma->nome_turma));

        return json_encode(array(
            'nomeTurma' => $nomeTurma.($i)
        ));
    }

    /**
     * 
     * @* @param int $idDisciplina
     * @* @param int $idProfessor
     * 
     * @return JSON
     */
    public function getTurmas($idDisciplina, $idProfessor) {
        $turmas = ProfessorHasTurma::join('professors', 'professors.id', '=', 'professor_has_turmas.professor_id')
                            ->join('turmas', 'turmas.id', '=', 'professor_has_turmas.turma_id')
                            ->join('disciplinas', 'disciplinas.id', '=', 'professor_has_turmas.disciplina_id')
                            ->where([
                                ['professors.id', '=', $idProfessor],
                                ['disciplinas.id', '=', $idDisciplina]
                            ])
                            ->select('turmas.id', 'turmas.nome_turma')
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
