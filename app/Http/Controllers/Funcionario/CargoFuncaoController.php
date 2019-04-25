<?php

namespace App\Http\Controllers\Funcionario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CargoFuncao;

/**
 * 
 * @author Juan Soares
 */
class CargoFuncaoController extends Controller {
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/funcionario/cargo';

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
        $cargos = CargoFuncao::all();
        return view('cargo.index', compact('cargos'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        $cargos = CargoFuncao::all();
        return view('cargo.cadastrar', compact('cargos'));
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $cargo = CargoFuncao::findOrFail($id);
        return view('cargo.editar', compact('cargo'));
    }

    /**
     * 
     * @* @param Request $request
     */
    public function store(Request $request) {
        $request->validate([
            'cargo_funcao' => 'required|unique:cargo_funcaos|max:100',
            'descricao' => 'required'
        ]);

        CargoFuncao::create([
            'cargo_funcao' => $request->cargo_funcao,
            'descricao'  => $request->descricao
        ]);

        return $this->index();
    }
}
