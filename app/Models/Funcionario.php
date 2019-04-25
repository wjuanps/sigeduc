<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Funcionario extends Model {
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];

    /**
     * 
     */
    public function pessoa() {
        return $this->belongsTo('App\Models\Pessoa');
    }

    /**
     * 
     */
    public function cargos() {
        return $this->belongsToMany('App\Models\CargoFuncao', 'funcionario_has_cargos', 'funcionario_id', 'cargo_id')
                        ->withPivot('carga_horaria', 'is_cargo_atual', 'created_at');
    }
}
