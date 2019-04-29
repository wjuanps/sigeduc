<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class CargoFuncao extends Model {
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];

    /**
     * 
     * @var Request
     */
    private $request;

    /**
     * 
     * @var CargoFuncao
     */
    private $cargoFuncao;

    /**
     * 
     * @* @param Request $request
     * 
     * @return CargoFuncao
     */
    public function salvarCargoFuncao(Request $request) : CargoFuncao {
        $request->validate([
            'cargo_funcao' => 'required|unique:cargo_funcaos|max:100',
            'descricao'    => 'required'
        ]);

        $this->request = $request;

        DB::transaction(function() {
            $this->cargoFuncao = $this->create([
                'cargo_funcao' => $this->request->cargo_funcao,
                'descricao'    => $this->request->descricao
            ]);
        });
        return $this->cargoFuncao;
    }

    /**
     * 
     * @* @param Request $request
     * 
     * @return CargoFuncao
     */
    public function updateCargoFuncao(Request $request) : CargoFuncao {
        return $this->update($request->all());
    }

    /**
     * 
     */
    public function funcionarios() {
        return $this->belongsToMany(Funcionario::class, 'funcionario_has_cargos', 'cargo_id', 'funcionario_id');
    }
}
