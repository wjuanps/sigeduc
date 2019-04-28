<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Endereco extends Model {
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */   
    protected $guarded = [];
    
    /**
     * 
     * @* @param Endereco $endereco
     * 
     * @return Endereco
     */
    public function salvarEndereco($endereco) : Endereco {
        Validator::make((array) $endereco, [
            'rua'    => 'required',
            'bairro' => 'required',
            'uf'     => 'required',
            'cidade' => 'required',
            'cep'    => 'required'
        ])->validate();

        if (is_array($endereco)) {
            $endereco = (object) $endereco;
        }

        return $this->create([
            'rua'         => $endereco->rua,
            'bairro'      => $endereco->bairro,
            'cep'         => $endereco->cep,
            'cidade'      => $endereco->cidade,
            'complemento' => $endereco->complemento,
            'uf'          => $endereco->uf
        ]);
    }

    /**
     * 
     */
    public function pessoa() {
        return $this->hasOne(Pessoa::class);
    }
}
