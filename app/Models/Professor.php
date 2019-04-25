<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Professor extends Model {
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
    public function formacoes() {
        return $this->hasMany('App\Models\Formacao');
    }

    /**
     * 
     */
    public function disciplinas() {
        return $this->belongsToMany('App\Models\Disciplina', 'professor_has_disciplinas');
    }

    /**
     * 
     */
    public function turmas() {
        return $this->belongsToMany('App\Models\Disciplina', 'professor_has_turmas');
    }

    /**
     * 
     */
    public function pessoa() {
        return $this->belongsTo('App\Models\Pessoa');
    }
    
    /**
     * 
     */
    public function frequencias() {
        return $this->hasMany('App\Models\Frequencia');
    }
}
