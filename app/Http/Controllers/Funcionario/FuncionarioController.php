<?php

namespace App\Http\Controllers\Funcionario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Funcionario;
use App\Models\CargoFuncao;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\FuncionarioHasCargo;

/**
 * 
 * @author Juan Soares
 */
class FuncionarioController extends Controller {
    
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
        $funcionarios = Funcionario::all();
        return view('funcionario.index', compact('funcionarios'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        $cargos = CargoFuncao::all();
        return view('funcionario.cadastrar', compact('cargos'));
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $funcionario = Funcionario::findOrFail($id);
        $cargos = CargoFuncao::all();
        return view('funcionario.editar', compact('funcionario', 'cargos'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function relatorio() {
        return view('funcionario.relatorio');
    }

    /**
     * 
     * @* @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        $funcionario = new Funcionario;
        $funcionario->salvarFuncionario($request);

        return $this->index();
    }

    public function teste(Request $request) {
        dd($request->all());
    }
}
