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
     */
    public function getDisciplinas($idProfessor) {
        $disciplinas = Professor::find($idProfessor)->disciplinas;
        return json_encode($disciplinas);
    }

    /**
     * 
     */
    public function getTurmas($idDisciplina, $idProfessor) {
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
     * @* @param Request $request
     */
    public function store(Request $request) {
        $request->validate([
            'disciplina' => 'required|unique:disciplinas|max:100',
            'descricao' => 'required'
        ]);

        Disciplina::create([
            'disciplina' => $request->disciplina,
            'descricao'  => $request->descricao
        ]);

        return $this->index();
    }

}
