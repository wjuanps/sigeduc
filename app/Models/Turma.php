<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     * @* @param Request $request
     * 
     * @return Turma
     */
    public function salvarTurma(Request $request) : Turma {
        $request->validate([
            'turma'       => 'required|unique:turmas',
            'serie'       => 'required|max:150',
            'turno'       => 'required|max:150',
            'modalidade'  => 'required',
            'professores' => 'required|json',
            'alunos'      => 'required|json|min:1'
        ]);

        DB::transaction(function () {
            $turma = Turma::create([
                'escola_id'       => 1,
                'turma'           => $request->turma,
                'serie'           => $request->serie,
                'turno'           => $request->turno,
                'modalidade'      => $request->modalidade,
                'descriao_turma'  => $request->descriao_turma,
                'descricao_serie' => $request->descricao_serie,
                'desativada_em'   => date_create()
            ]);
            
            $professores = json_decode($request->professores);
            if (isset($professores) && count($professores) > 0) {
                foreach ($professores as $professor) {
                    $turma->professores()->attach($professor->idProfessor, [
                        'disciplina_id' => $professor->idDisciplina
                    ]);
                }
            }
            
            $alunos = json_decode($request->alunos);
            if (isset($alunos) && count($alunos) > 0) {
                foreach ($alunos as $aluno) {
                    $turma->alunos()->attach($aluno->id, [
                        'ano' => date_format(date_create(), 'Y'),
                        'is_repetente' => 0
                    ]);
                }
            }
    
            return $turma;
        });
        return null;
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
                        ->withPivot('disciplina_id');
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
                        ->withPivot('ano', 'is_repetente');
    }
}
