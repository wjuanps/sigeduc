<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * 
 * @author Juan Soares
 */
class Nota extends Model {
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];

    /**
     * 
     * @* @param int $idAluno
     * @* @param int $idProfessor
     * @* @param int $idTurma
     * @* @param int $idDisciplina
     * 
     */
    public static function getNotas($idAluno, $idProfessor, $idTurma, $idDisciplina) {
        return (
            Nota::join('alunos', 'alunos.id', '=', 'notas.aluno_id')
                ->join('professors', 'professors.id', 'notas.professor_id')
                ->join('turmas', 'turmas.id', 'notas.turma_id')
                ->join('disciplinas', 'disciplinas.id', 'notas.disciplina_id')
                ->where([
                    ['notas.aluno_id', '=', $idAluno],
                    ['notas.professor_id', '=', $idProfessor],
                    ['notas.turma_id', '=', $idTurma],
                    ['notas.disciplina_id', '=', $idDisciplina]
                ])
                ->select([
                    'notas.id', 'notas.avaliacao', 'notas.nota', 'notas.anotacoes'
                ])
                ->get()
        );
    }

    /**
     * 
     * @* @param Aluno $aluno
     */
    public static function lancarNotas($aluno) {
        DB::transaction(function () use (&$aluno) {
            if (isset($aluno->notas) && count($aluno->notas) > 0) {
                foreach ($aluno->notas as $nota) {
                    $newNota = Nota::find($nota->id);
                    $newNota->update((array) $nota);
                }
            }

            if (isset($aluno->tempNotas) && count($aluno->tempNotas) > 0) {
                foreach ($aluno->tempNotas as $tempNota) {
                    if ($tempNota->nota != '' && $tempNota->avaliacao != '') {
                        Nota::create([
                            'nota'          => $tempNota->nota,
                            'avaliacao'     => $tempNota->avaliacao,
                            'anotacoes'     => $tempNota->anotacoes,
                            'turma_id'      => $aluno->turma_id,
                            'professor_id'  => $aluno->professor_id,
                            'aluno_id'      => $aluno->id,
                            'disciplina_id' => $aluno->disciplina_id
                        ]);
                    }
                }
            }
        });
    }
}
