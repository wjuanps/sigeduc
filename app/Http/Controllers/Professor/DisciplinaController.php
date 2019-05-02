<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Disciplina;
use App\Models\Professor;

/**
 * 
 * @author Juan Soares
 */
class DisciplinaController extends Controller {
    
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
        $disciplinas = Disciplina::all();
        return view('disciplina.index', compact('disciplinas'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        return view('disciplina.cadastrar');
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplina.editar', compact('disciplina'));
    }

    /**
     * 
     * @* @param int $idProfessor
     * @* @param int $idTurma
     */
    public function getDisciplinas($idProfessor, $idTurma) {
        if ($idTurma > 0) {
            $disciplinas = Disciplina::join('professor_has_disciplinas', 'disciplinas.id', '=', 'professor_has_disciplinas.disciplina_id')
                                        ->join('professors', 'professors.id', '=', 'professor_has_disciplinas.professor_id')
                                        ->join('professor_has_turmas', [
                                            ['professors.id', '=', 'professor_has_turmas.professor_id'], 
                                            ['disciplinas.id', '=', 'professor_has_turmas.disciplina_id']
                                        ])
                                        ->join('turmas', 'turmas.id','=', 'professor_has_turmas.turma_id')
                                        ->where([
                                            ['turmas.id', '=', $idTurma],
                                            ['professors.id', '=', $idProfessor]
                                        ])
                                        ->select(['disciplinas.id', 'disciplinas.disciplina'])
                                        ->get()->unique();
        } else {
            $disciplinas = Professor::find($idProfessor)->disciplinas;
        }

        return json_encode($disciplinas);
    }
    
    /**
     * 
     * @* @param Request $request
     */
    public function store(Request $request) {
        $disciplina = new Disciplina;
        $disciplina->salvarDisciplina($request);
        return $this->index();
    }

    /**
     * 
     * @* @param Request $request
     */
    public function update(Request $request) {
        $disciplina = Disciplina::findOrFail($request->id);
        $disciplina->updateDisciplina($request);
        return $this->index();
    }

}
