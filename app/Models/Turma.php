<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

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
     * @var Turma
     */
    public $turma;

    /**
     * 
     * @var Aluno
     */
    public $aluno;

    /**
     * 
     * @* @param Request $request
     * 
     * @return Turma
     */
    public function salvarTurma(Request $request) : Turma {
        $request->validate([
            'nome_turma'  => 'required|unique:turmas',
            'serie'       => 'required|max:150',
            'turno'       => 'required|max:150',
            'modalidade'  => 'required'
        ]);

        DB::transaction(function () use (&$request) {
            $this->turma = Turma::create([
                'escola_id'       => 1,
                'nome_turma'      => $request->nome_turma,
                'serie'           => $request->serie,
                'turno'           => $request->turno,
                'modalidade'      => $request->modalidade,
                'ano'             => $request->ano,
                'descriao_turma'  => $request->descriao_turma,
                'descricao_serie' => $request->descricao_serie,
                'desativada_em'   => date_create()
            ]);
        });
        return $this->turma;
    }

    /**
     * 
     * @* @param Request $request
     */
    public function salvarAluno(Request $request) {
        DB::transaction(function () use (&$request) {
            $novosAlunos = array_unique($request->alunos);
            foreach ($this->alunos as $aluno) {
                if (in_array($aluno->id, $novosAlunos)) {
                    $novosAlunos = array_filter($novosAlunos, function ($value) use (&$aluno) {
                        return $aluno->id != $value;
                    });
                }
            }

            if (count($novosAlunos) > 0) {
                $repetente = array_filter($request->is_repetente, function ($value) {
                    return !is_null($value);
                });
                
                $is_repetente = boolval(Arr::first($repetente));
                $novoAluno = intval(Arr::first($novosAlunos));
    
                if ($novoAluno > 0) {
                    $this->alunos()->attach($novoAluno, [
                        'is_repetente' => $is_repetente
                    ]);
                }
            }
        });
    }

    /**
     * 
     * @* @param Request $request
     */
    public function salvarProfessor(Request $request) {
        DB::transaction(function () use (&$request) {
            for ($i = 0; $i < count($request->professor_ids) && $i < count($request->disciplina_ids); $i++) {
                $professores = $this->professores()->where([
                    ['professor_id', '=', $request->professor_ids[$i]],
                    ['disciplina_id', '=', $request->disciplina_ids[$i]]
                ])->get();

                if (count($professores) > 0) continue;

                $this->professores()->attach($this->id, [
                    'professor_id'  => $request->professor_ids[$i],
                    'disciplina_id' => $request->disciplina_ids[$i]
                ]);
            }
        });
    }

    /**
     * 
     */
    public function escola() {
        return $this->belongsTo(Escola::class);
    }

    /**
     * 
     */
    public function professores() {
        return $this->belongsToMany(Professor::class, 'professor_has_turmas')
                        ->withPivot('disciplina_id', 'professor_id');
    }
        
    /**
     * 
     */
    public function disciplinas() {
        return $this->belongsToMany(Disciplina::class, 'professor_has_turmas');
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
    public function alunos() {
        return $this->belongsToMany(Aluno::class, 'aluno_has_turmas')
                        ->withPivot('is_repetente');
    }
}
