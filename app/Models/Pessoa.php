<?php

namespace App\Models;

use Validator;
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
     * @* @param Pessoa $pessoa
     * 
     * @return Pessoa
     */
    public function salvarPessoa($pessoa) : Pessoa {
        Validator::make((array) $pessoa, [
            'cpf'             => 'required|max:25|unique:pessoas',
            'rg'              => 'required|max:25|unique:pessoas',
            'nome'            => 'required|max:150',
            'email'           => 'required|max:150|email|unique:pessoas',
            'data_nascimento' => 'required',
            'sexo'            => 'required',
            'celular'         => 'required'
        ])->validate();

        $endereco = new Endereco;
        $endereco = $endereco->salvarEndereco($pessoa);

        if (is_array($pessoa)) {
            $pessoa = (object) $pessoa;
        }
            
        $dataNascimento = explode('/', $pessoa->data_nascimento);
        $dataNascimento = implode('-', array_reverse($dataNascimento));

        return $this->create([
            'endereco_id'     => $endereco->id,
            'celular'         => $pessoa->celular,
            'cpf'             => $pessoa->cpf,
            'data_nascimento' => $dataNascimento,
            'email'           => $pessoa->email,
            'rg'              => $pessoa->rg,
            'foto'            => $pessoa->foto,
            'nacionalidade'   => $pessoa->nacionalidade,
            'naturalidade'    => $pessoa->naturalidade,
            'nome'            => $pessoa->nome,
            'sexo'            => $pessoa->sexo,
            'telefone'        => $pessoa->telefone,
            'naturalidade_uf' => $pessoa->naturalidade_uf
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
    
    /**
     * 
     */
    public function responsavel() {
        return $this->hasOne(Responsavel::class);
    }
}
