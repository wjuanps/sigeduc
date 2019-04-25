<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Turma extends Model {
        
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];

    /**
     * 
     */
    public function escola() {
        return $this->belongsTo('App\Models\Escola');
    }

    /**
     * 
     */
    public function professores() {
        return $this->belongsToMany('App\Models\Professor', 'professor_has_turmas')
                        ->withPivot('disciplina_id');
    }
        
    /**
     * 
     */
    public function disciplinas() {
        return $this->belongsToMany('App\Models\Disciplina', 'professor_has_turmas');
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
    public function alunos() {
        return $this->belongsToMany('App\Models\Aluno', 'aluno_has_turmas')
                        ->withPivot('ano', 'is_repetente');
    }
}
