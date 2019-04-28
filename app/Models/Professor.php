<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     * @var Request
     */
    private $request;

    /**
     * 
     * @var Professor
     */
    private $professor;

    /**
     * 
     * @* @param Request $request
     * 
     * @return Professor
     */
    public function salvarProfessor(Request $request) : Professor {
        $request->validate([
            'formacoes'   => 'required|json',
            'disciplinas' => 'required|array'
        ]);
        
        $this->request = $request;

        DB::transaction(function () {
            $pessoa = new Pessoa;
            $pessoa = $pessoa->salvarPessoa($this->request->all());
            
            $this->professor = $pessoa->professor()->create(['pessoa_id' => $pessoa->id]);
    
            foreach ($this->request->disciplinas as $disciplina) {
                $this->professor->disciplinas()->attach($disciplina);
            }
        
            $formacoes = json_decode($this->request->formacoes);
            foreach ($formacoes as $formacao) {
                $this->professor->formacoes()->create([
                    'ano_inicio'  => $formacao->anoInicio,
                    'ano_termino' => $formacao->anoTermino,
                    'curso'       => $formacao->curso,
                    'diploma'     => null,
                    'instituicao' => $formacao->instituicao,
                    'titulo'      => $formacao->titulo
                ]);
            }
    
        });
        return $this->professor;
    }

    /**
     * 
     */
    public function formacoes() {
        return $this->hasMany(Formacao::class);
    }

    /**
     * 
     */
    public function disciplinas() {
        return $this->belongsToMany(Disciplina::class, 'professor_has_disciplinas');
    }

    /**
     * 
     */
    public function turmas() {
        return $this->belongsToMany(Disciplina::class, 'professor_has_turmas');
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
    public function frequencias() {
        return $this->hasMany(Frequencia::class);
    }
}
