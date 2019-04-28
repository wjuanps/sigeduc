<?php

namespace App\Models;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Aluno extends Model {
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];

    /**
     * 
     * @var Aluno
     */
    private $aluno;

    /**
     * 
     * @var Request
     */
    private $request;

    /**
     * 
     * @* @param Request $request
     * 
     * @return Aluno
     */
    public function salvarAluno(Request $request) : Aluno {
        $request->validate([
            'matricula'         => 'required|max:15|unique:alunos',
            'responsaveisAluno' => 'required|json'
        ]);

        $this->request = $request;

        DB::transaction(function () {
            $pessoa = new Pessoa;
            $pessoa = $pessoa->salvarPessoa($this->request->all());

            $this->aluno = $pessoa->aluno()->create([
                'pessoa_id'         => $pessoa->id,
                'matricula'         => $this->request->matricula,
                'pai_declarado'     => !is_null($this->request->pai_declarado),
                'pratica_ed_fisica' => !is_null($this->request->pratica_ed_fisica),
                'irmao_na_escola'   => !is_null($this->request->irmao_na_escola)
            ]);

            $responsaveis = json_decode($this->request->responsaveisAluno);
            if (isset($responsaveis) && count($responsaveis) > 0) {
                foreach ($responsaveis as $alunoResponsavel) {
                    Validator::make((array) $alunoResponsavel->alunoHasResponsavel, [
                        'mora_com_filho' => 'required',
                        'parentesco'     => 'required|string'
                    ])->validate();

                    $idResponsavel = $alunoResponsavel->responsavel->id;
                    if (!$idResponsavel) {
                        $responsavel = new Responsavel;
                        $idResponsavel = $responsavel->salvarResponsavel($alunoResponsavel->responsavel);
                    }
                    
                    $this->aluno->responsaveis()->attach($idResponsavel, [
                        'parentesco'            => $alunoResponsavel->alunoHasResponsavel->parentesco,
                        'mora_com_filho'        => $alunoResponsavel->alunoHasResponsavel->mora_com_filho,
                        'outro_filho_na_escola' => $alunoResponsavel->alunoHasResponsavel->outro_filho_na_escola
                    ]);
                }
            }
        });
        return $this->aluno;
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
    public function responsaveis() {
        return $this->belongsToMany(Responsavel::class, 'aluno_has_responsavels')
                        ->withPivot('parentesco', 'mora_com_filho', 'outro_filho_na_escola');
    }

    /**
     * 
     */
    public function turmas() {
        return $this->belongsToMany(Turma::class, 'aluno_has_turmas')
                        ->withPivot('ano', 'is_repetente');
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
    public function notas() {
        return $this->hasMany(Nota::class);
    }
}
