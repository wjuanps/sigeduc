<?php

namespace App\Http\Controllers\Fornecedor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Fornecedor;

/**
 * 
 * @author Juan Soares
 */
class FornecedorController extends Controller {
    
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
        $fornecedores = Fornecedor::all();
        return view('fornecedor.index', compact('fornecedores'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        return view('fornecedor.cadastrar');
    }

    /**
     * 
     * @* @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedor.editar', compact('fornecedor'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function relatorio() {
        return view('fornecedor.relatorio');
    }

    /**
     * 
     * @* @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        $fornecedor = new Fornecedor;
        $fornecedor->salvarFornecedor($request);
        return $this->index();
    }

    public function teste(Request $request) {
        dd($request->all());
    }
}
