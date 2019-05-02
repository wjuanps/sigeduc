<?php

namespace App\Http\Controllers\Aluno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Aluno;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Responsavel;
use App\Models\Turma;
use App\Models\Nota;

/**
 * 
 * @author Juan Soares
 */
class AlunoController extends Controller {
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the index of the teacher's module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $alunos = Aluno::all();
        return view('aluno.index', compact('alunos'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cadastrar() {
        $disciplinas = Disciplina::where('is_ativa', true)->get();
        return view('aluno.cadastrar', compact('disciplinas'));
    }

    /**
     * 
     * @* @param int $id
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editar(int $id) {
        try {
            $aluno = Aluno::findOrFail($id);
            $disciplinas = Disciplina::where('is_ativa', true)->get();
            return view('aluno.editar', compact('aluno', 'disciplinas'));
        } catch (HttpException $th) {
            dd($th);
        }
    }

    /**
     * 
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewLancarNota() {
        $aluno = (object) array(
            'anoLetivo' => date_format(date_create(), 'Y'),
            'nomeAluno' => ''
        );
        return view('aluno.lancar-nota', compact('aluno'));
    }

    /**
     * 
     * @* @param Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lancarNota(Request $request) {
        
        $alunoSelecionado = null;
        $professores = null;
        if (isset($request->alunoSelecionado)) {
            $alunoSelecionado = json_decode($request->alunoSelecionado);
            
            if (isset($request->professor) && isset($request->disciplina)) {
                $notas = Nota::getNotas($alunoSelecionado->id, $request->professor, $alunoSelecionado->turma_id, $request->disciplina);
                
                $alunoSelecionado->notas = $notas;
                $alunoSelecionado->professor_id = $request->professor;
                $alunoSelecionado->disciplina_id = $request->disciplina;
            }
            
            if (!isset($alunoSelecionado->tempNotas)) {
                $nota = new Nota([
                    'index' => 0,
                    'nota' => '',
                    'avaliacao' => '',
                    'anotacoes' => ''
                ]);

                $alunoSelecionado->tempNotas = array();
                array_push($alunoSelecionado->tempNotas, $nota);
            }
            
            if (isset($request->atualizarNota)) {
                foreach ($alunoSelecionado->notas as $nota) {
                    if ($nota->id == $request->atualizarNota) {
                        $nota->nota = $request->nota;
                        $nota->avaliacao = $request->avaliacao;
                        $nota->anotacoes = $request->anotacoes;

                        break;
                    }
                }
            }

            if (isset($request->adicionarAvaliacao)) {
                try {
                    $alunoSelecionado->tempNotas[$request->adicionarAvaliacao]->nota      = $request->nota;
                    $alunoSelecionado->tempNotas[$request->adicionarAvaliacao]->avaliacao = $request->avaliacao;
                    $alunoSelecionado->tempNotas[$request->adicionarAvaliacao]->anotacoes = $request->anotacoes;
                    
                    $nota = new Nota([
                        'index' => $request->adicionarAvaliacao + 1,
                        'nota' => '',
                        'avaliacao' => '',
                        'anotacoes' => ''
                    ]);

                    array_push($alunoSelecionado->tempNotas, $nota);
                } catch (\Throwable $th) {}
            }
            
            if (isset($request->atualizarAvaliacao)) {
                try {
                    $alunoSelecionado->tempNotas[$request->atualizarAvaliacao]->nota      = $request->nota;
                    $alunoSelecionado->tempNotas[$request->atualizarAvaliacao]->avaliacao = $request->avaliacao;
                    $alunoSelecionado->tempNotas[$request->atualizarAvaliacao]->anotacoes = $request->anotacoes;
                } catch (\Throwable $th) {}
            }
            
            if (isset($request->removerAvaliacao)) {
                $temps = $alunoSelecionado->tempNotas;
                unset($temps[$request->removerAvaliacao]);
                $alunoSelecionado->tempNotas = array();
                $i = 0;
                if (is_array($temps)) {
                    foreach ($temps as $temp) {
                        $temp->index = $i++;
                        array_push($alunoSelecionado->tempNotas, $temp);
                    }
                } else {
                    $temp->index = $i++;
                    array_push($alunoSelecionado->tempNotas, $temps);
                }
            }

            $professores = Professor::getProfessores($alunoSelecionado->turma_id);
        }

        $aluno = (object) array(
            'anoLetivo' => date_format(date_create(), 'Y'),
            'nomeAluno' => ''
        );

        $alunos = null;
        if (isset($request->anoLetivo) && isset($request->nomeAluno)) {
            $aluno = (object) array(
                'anoLetivo' => $request->anoLetivo,
                'nomeAluno' => $request->nomeAluno
            );
    
            $alunos = Aluno::getAlunos($request->nomeAluno);
        }

        if (isset($request->lancarNotas)) {
            Nota::lancarNotas($alunoSelecionado);
            $notas = Nota::getNotas($alunoSelecionado->id, $alunoSelecionado->professor_id, $alunoSelecionado->turma_id, $alunoSelecionado->disciplina_id);
            $success = 'Sucesso';
            return view('aluno.lancar-nota', compact('aluno', 'success'));
        }

        return view('aluno.lancar-nota', compact('alunos', 'aluno', 'alunoSelecionado', 'professores'));
    }
    
    /**
     * 
     * @* @param Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editarTurmas(Request $request) {
        
        $aluno = Aluno::findOrFail($request->id_aluno);

        if (isset($request->turmas)) {
            $aluno->salvarTurma($request);
            $aluno = Aluno::findOrFail($request->id_aluno);
        }

        $alunoTurmas = array();
        foreach ($aluno->turmas as $turma) {
            array_push($alunoTurmas, $turma);
        }
        
        $turmas = Turma::where([
            ['modalidade', '=', $request->modalidade],
            ['turno', '=', $request->turno],
            ['serie', '=', $request->serie]
        ])->get();
            
        $turma = null;
        if (isset($request->id_turma)) {
            $turma = Turma::findOrFail($request->id_turma);
            $turma->is_repetente = (isset($request->is_repetente));
            array_unshift($alunoTurmas, $turma);
        }

        return view('aluno.editar-turmas', compact('aluno', 'turmas', 'alunoTurmas'));
    }

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function relatorio() {
        return view('aluno.relatorio');
    }
    
    /**
     * 
     * @* @param String $search
     * 
     * @return App\Models\Aluno
     */
    public function getResponsaveis($search) {
        $responsaveis = Responsavel::join('pessoas', 'pessoas.id', '=', 'responsavels.pessoa_id')
                            ->where('pessoas.nome', 'like', '%'.$search.'%')
                            ->select([
                                'responsavels.id', 'pessoas.nome', 'pessoas.telefone', 
                                'pessoas.celular', 'pessoas.email', 'pessoas.cpf'
                            ])
                            ->get();
    
        return json_encode($responsaveis);
    }
    
    /**
     * 
     * @* @param Request $request
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) {
        $responsaveis = json_decode($request->responsaveisAluno);
        if (!isset($responsaveis) || count($responsaveis) <= 0) {
            return redirect()
                        ->back()
                        ->withErrors(['Responsável' => 'Informe ao menos um responsável']);
        }

        $aluno = new Aluno;
        $aluno = $aluno->salvarAluno($request);

        if ($aluno instanceof Aluno) {
            return $this->index();
        }
    }
    
    /**
     * 
     */
    public function teste(Request $request) {
        $turma = Turma::find($request->id_turma);
        dd($turma);
    }
}
