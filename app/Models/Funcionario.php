<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Funcionario extends Model {
    
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
     * @return Funcionario
     */
    public function salvarFuncionario(Request $request) : Funcionario {
        $request->validate([
            'numero_ctps'           => 'required|unique:funcionarios',
            'numero_pis'            => 'required|unique:funcionarios',
            'serie_ctps'            => 'required|unique:funcionarios',
            'data_emissao_carteira' => 'required',
            'escolaridade'          => 'required'
        ]);

        DB::transaction(function () {
            $pessoa = new Pessoa;
            $pessoa = $pessoa->salvarPessoa($request);
    
            $dataEmissaoCarteira = explode('/', $request->data_emissao_carteira);
            $dataEmissaoCarteira = implode('-', array_reverse($dataEmissaoCarteira));
    
            $funcionario = $pessoa->funcionario()->create([
                'pessoa_id'             => $pessoa->id,
                'data_emissao_carteira' => $dataEmissaoCarteira,
                'qtd_dependentes'       => $request->qtd_dependentes,
                'escolaridade'          => $request->escolaridade,
                'numero_ctps'           => $request->numero_ctps,
                'numero_pis'            => $request->numero_pis,
                'serie_ctps'            => $request->serie_ctps
            ]);
    
            $cargos = json_decode($request->funcionarioCargos);
            foreach ($cargos as $cargo) {
                $funcionario->cargos()->attach($cargo->id, [
                    'is_cargo_atual' => $cargo->cargoAtual,
                    'carga_horaria'  => $cargo->cargaHoraria
                ]);
            }
    
            return $funcionario;
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
    public function cargos() {
        return $this->belongsToMany(CargoFuncao::class, 'funcionario_has_cargos', 'funcionario_id', 'cargo_id')
                        ->withPivot('carga_horaria', 'is_cargo_atual', 'created_at');
    }
}
