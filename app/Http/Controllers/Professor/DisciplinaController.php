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
