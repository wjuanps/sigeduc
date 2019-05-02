<?php

namespace App\Models;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

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
     * @var Turma
     */
    private $turma;

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
     * @* @param Request $request
     */
    public function salvarTurma(Request $request) {
        $this->request = $request;

        DB::transaction(function () {
            $novasTurmas = array_unique($this->request->turmas);
            foreach ($this->turmas as $turma) {
                $this->turma = $turma;
                if (in_array($turma->id, $novasTurmas)) {
                    $novasTurmas = array_filter($novasTurmas, function ($e) {
                        return $this->turma->id != $e;
                    });
                }
            }

            if (count($novasTurmas) > 0) {
                $repetente = array_filter($this->request->is_repetente, function ($value) {
                    return !is_null($value);
                });
                
                $is_repetente = boolval(Arr::first($repetente));
                $novaTurma = intval(Arr::first($novasTurmas));
    
                if ($novaTurma > 0) {
                    $this->turmas()->attach($novaTurma, [
                        'is_repetente' => $is_repetente
                    ]);
                }
            }
        });
    }

    /**
     * 
     * @* @param int $idTurma
     * 
     * @return Collection
     */
    public static function getAlunos(string $nomeAluno) : Collection {
        return (
            Aluno::join('pessoas', 'pessoas.id', '=', 'alunos.pessoa_id')
                ->join('aluno_has_turmas', 'aluno_has_turmas.aluno_id', '=', 'alunos.id')
                ->join('turmas', 'aluno_has_turmas.turma_id', '=', 'turmas.id')
                ->where([
                    ['pessoas.nome', 'like', '%'. $nomeAluno .'%']
                ])
                ->select([
                    'alunos.id', 'alunos.matricula', 'pessoas.nome', 'pessoas.cpf',
                    'turmas.nome_turma', 'turmas.id as turma_id',
                    'turmas.serie', 'turmas.modalidade', 'turmas.ano',
                ])
                ->get()
        );
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
                        ->withPivot('is_repetente');
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
