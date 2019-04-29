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
     * @var Request
     */
    private $request;

    /**
     * 
     * @var Fornecedor
     */
    private $fornecedor;

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

        $this->request = $request;

        DB::transaction(function () {
            $dataFundacao = explode('/', $this->request->data_fundacao);
            $dataFundacao = implode('-', array_reverse($dataFundacao));
    
            $endereco = new Endereco;
            $endereco = $endereco->salvarEndereco($this->request->all());
    
            $this->fornecedor = Fornecedor::create([
                'cnpj'               => $this->request->cnpj,
                'endereco_id'        => $endereco->id,
                'celular'            => $this->request->celular,
                'email'              => $this->request->email,
                'telefone'           => $this->request->telefone,
                'data_fundacao'      => $dataFundacao,
                'inscricao_estadual' => $this->request->inscricao_estadual,
                'nome_fantasia'      => $this->request->nome_fantasia,
                'razao_social'       => $this->request->razao_social,
                'segmento'           => $this->request->segmento,
                'site'               => $this->request->site,
                'logo'               => $this->request->logo,
                'tipo'               => $this->request->tipo
            ]);
        });
        return $this->fornecedor;
    }

    /**
     * 
     */
    public function endereco() {
        return $this->belongsTo(Endereco::class);
        
    }
}
