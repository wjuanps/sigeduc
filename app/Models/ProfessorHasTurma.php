<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class ProfessorHasTurma extends Model {
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
        
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];

    /**
     * 
     */
    public function turmas() {
        return $this->belongsToMany(Turma::class, 'professor_has_turmas')
                        ->withPivot('disciplina_id', 'professor_id');
    }

    /**
     * 
     */
    public function professores() {
        return $this->belongsToMany(Professor::class, 'professor_has_turmas')
                        ->withPivot('disciplina_id', 'professor_id');
    }
}
