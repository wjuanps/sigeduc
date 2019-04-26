<?php

namespace App\Models;

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
     * @* @param Request $request
     * 
     * @return Aluno
     */
    public function salvarAluno(Request $request) {

        // $request->validate([
        //     'matricula'         => 'required|max:15|unique:alunos',
        //     'pai_declarado'     => 'required',
        //     'pratica_ed_fisica' => 'required',
        //     'irmao_na_escola'   => 'required',
        //     'responsaveisAluno' => 'required|json',
        //     'turmasAluno'       => 'required|json'
        // ]);
        DB::transaction(function () {
            // $pessoa = new Pessoa;
            // $pessoa = $pessoa->salvarPessoa($request);
            
            // $aluno = $pessoa->aluno()->create([
            //     'pessoa_id'         => $pessoa->id,
            //     'matricula'         => $request->matricula,
            //     'pai_declarado'     => $request->pai_declarado,
            //     'pratica_ed_fisica' => $request->pratica_ed_fisica,
            //     'irmao_na_escola'   => $request->irmao_na_escola
            // ]);
    
            $responsaveis = json_decode($request->responsaveisAluno);
            // if (isset($responsaveis) && count($responsaveis) > 0) {
                foreach ($responsaveis as $responsavel) {
                    $res = new Responsavel;
                    $res->salvarResponsavel($responsavel);
                }
            // }
    
            // return $aluno;
        });
        return null;
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
