<?php

namespace App\Models;

use Validator;
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
     * @return Responsavel
     */
    public function salvarResponsavel($responsavel) {
        $validator = Validator::make((array) $responsavel, [
            'nome' => 'required'
        ])->validate();

        dd($responsavel);

    }

    /**
     * 
     */
    public function pessoa() {
        return $this->belongsTo(Pessoa::class);
    }

    /**
     * 
     */
    public function filhos() {
        return $this->belongsToMany(Aluno::class, 'aluno_has_responsavels')
                        ->withPivot('parentesco', 'mora_com_filho', 'outro_filho_na_escola');
    }

}
