<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Disciplina extends Model {
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];
    
    /**
     * 
     */
    public function frequencias() {
        return $this->hasMany('App\Models\Frequencia');
    }

    /**
     * 
     */
    public function professores() {
        return $this->belongsToMany('App\Models\Professor', 'professor_has_disciplinas');
    }
    
    /**
     * 
     */
    public function turmas() {
        return $this->belongsToMany('App\Models\Turma', 'professor_has_turmas');
    }
}
