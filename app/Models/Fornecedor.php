<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Fornecedor extends Model {
    
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
     * @return Fornecedor
     */
    public function salvarFornecedor(Request $request) : Fornecedor {
        $request->validate([
            'cnpj'          => 'required|unique:fornecedors',
            'nome_fantasia' => 'required|max:150',
            'razao_social'  => 'required',
            'tipo'          => 'required',
            'segmento'      => 'required',
            'data_fundacao' => 'required',
            'celular'       => 'required'
        ]);

        DB::transaction(function () {
            $dataFundacao = explode('/', $request->data_fundacao);
            $dataFundacao = implode('-', array_reverse($dataFundacao));
    
            $endereco = new Endereco;
            $endereco = $endereco->salvarEndereco($request);
    
            return Fornecedor::create([
                'cnpj'               => $request->cnpj,
                'endereco_id'        => $endereco->id,
                'celular'            => $request->celular,
                'email'              => $request->email,
                'telefone'           => $request->telefone,
                'data_fundacao'      => $dataFundacao,
                'inscricao_estadual' => $request->inscricao_estadual,
                'nome_fantasia'      => $request->nome_fantasia,
                'razao_social'       => $request->razao_social,
                'segmento'           => $request->segmento,
                'site'               => $request->site,
                'logo'               => $request->logo,
                'tipo'               => $request->tipo
            ]);
        });
        return null;
    }

    /**
     * 
     */
    public function endereco() {
        return $this->belongsTo(Endereco::class);
        
    }
}
