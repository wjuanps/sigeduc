<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Responsavel extends Model {
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * 
     */
    public function pessoa() {
        return $this->belongsTo('App\Models\Pessoa');
    }

    /**
     * 
     */
    public function filhos() {
        return $this->belongsToMany('App\Models\Aluno', 'aluno_has_responsavels')
                        ->withPivot('parentesco', 'mora_com_filho', 'outro_filho_na_escola');
    }

}
