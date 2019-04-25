<?php

namespace App\Models;

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
     */
    public function funcionarios() {
        return $this->belongsToMany('App\Models\Funcionario', 'funcionario_has_cargos', 'funcionario_id', 'cargo_id');
    }
}
