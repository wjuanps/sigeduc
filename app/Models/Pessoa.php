<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Pessoa extends Model {
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];

    /**
     * 
     * @* @param Request $request
     */
    public function salvarPessoa(Request $request) : Pessoa {
        $request->validate([
            'cpf'             => 'required|max:25|unique:pessoas',
            'rg'              => 'required|max:25|unique:pessoas',
            'nome'            => 'required|max:150',
            'email'           => 'required|max:150|email|unique:pessoas',
            'data_nascimento' => 'required',
            'sexo'            => 'required',
            'celular'         => 'required'
        ]);

        $endereco = new Endereco;
        $endereco = $endereco->salvarEndereco($request);

        $dataNascimento = explode('/', $request->data_nascimento);
        $dataNascimento = implode('-', array_reverse($dataNascimento));

        return $this->create([
            'endereco_id'     => $endereco->id,
            'celular'         => $request->celular,
            'cpf'             => $request->cpf,
            'data_nascimento' => $dataNascimento,
            'email'           => $request->email,
            'rg'              => $request->rg,
            'foto'            => $request->foto,
            'nacionalidade'   => $request->nacionalidade,
            'naturalidade'    => $request->naturalidade,
            'nome'            => $request->nome,
            'sexo'            => $request->sexo,
            'telefone'        => $request->telefone,
            'naturalidade_uf' => $request->naturalidade_uf
        ]);
    }

    /**
     * 
     */
    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }
    
    /**
     * 
     */
    public function professor() {
        return $this->hasOne(Professor::class);
    }
    
    /**
     * 
     */
    public function aluno() {
        return $this->hasOne(Aluno::class);
    }
    
    /**
     * 
     */
    public function funcionario() {
        return $this->hasOne(Funcionario::class);
    }
}
