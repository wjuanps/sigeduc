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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];

    /**
     * 
     * @* @param Responsavel $responsavel
     * 
     * @return int
     */
    public function salvarResponsavel($responsavel) : int {
        $pessoa = new Pessoa;
        $pessoa = $pessoa->salvarPessoa($responsavel);

        $responsavel = $pessoa
                        ->responsavel()
                        ->create([
                            'pessoa_id' => $pessoa->id
                        ]);
        return $responsavel->id;
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
