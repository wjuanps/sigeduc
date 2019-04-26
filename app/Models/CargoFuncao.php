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
     * @* @param Request $request
     * 
     * @return CargoFuncao
     */
    public function salvarCargoFuncao(Request $request) : CargoFuncao {
        $request->validate([
            'cargo_funcao' => 'required|unique:cargo_funcaos|max:100',
            'descricao'    => 'required'
        ]);

        DB::transaction(function() {
            return $this->create([
                'cargo_funcao' => $request->cargo_funcao,
                'descricao'    => $request->descricao
            ]);
        });
        return null;
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
