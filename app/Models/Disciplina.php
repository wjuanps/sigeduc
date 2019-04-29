<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     * @var Request
     */
    private $request;

    /**
     * 
     * @var Disciplina
     */
    private $disciplina;
    
    /**
     * 
     * @* @param Request $request
     * 
     * @return Disciplina
     */
    public function salvarDisciplina(Request $request) : Disciplina {
        $request->validate([
            'disciplina' => 'required|unique:disciplinas|max:100',
            'descricao'  => 'required'
        ]);

        $this->request = $request;

        DB::transaction(function () {
            $this->disciplina = $this->create([
                'disciplina' => $this->request->disciplina,
                'descricao'  => $this->request->descricao
            ]);
        });
        return $this->disciplina;
    }

    /**
     * 
     * @* @param Request $request
     * 
     * @return Disciplina
     */
    public function updateDisciplina(Request $request) : Disciplina {
        return $this->update($request->all());
    }

    /**
     * 
     */
    public function frequencias() {
        return $this->hasMany(Frequencia::class);
    }

    /**
     * 
     */
    public function professores() {
        return $this->belongsToMany(Professor::class, 'professor_has_disciplinas');
    }
    
    /**
     * 
     */
    public function turmas() {
        return $this->belongsToMany(Turma::class, 'professor_has_turmas');
    }
}
