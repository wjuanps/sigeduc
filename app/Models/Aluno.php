<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Aluno extends Model {
    
    /**
     * 
     */
    public function pessoa() {
        return $this->belongsTo('App\Models\Pessoa');
    }

    /**
     * 
     */
    public function responsaveis() {
        return $this->belongsToMany('App\Models\Responsavel', 'aluno_has_responsavels')
                        ->withPivot('parentesco', 'mora_com_filho', 'outro_filho_na_escola');
    }

    /**
     * 
     */
    public function turmas() {
        return $this->belongsToMany('App\Models\Turma', 'aluno_has_turmas')
                        ->withPivot('ano', 'is_repetente');
    }

    /**
     * 
     */
    public function frequencias() {
        return $this->hasMany('App\Models\Frequencia');
    }

    /**
     * 
     */
    public function notas() {
        return $this->hasMany('App\Models\Nota');
    }
}
