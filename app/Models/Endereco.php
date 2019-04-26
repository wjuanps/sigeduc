<?php

namespace App\Models;

use Illuminate\Http\Request;
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
     * @* @param Request $request
     * 
     * @return Endereco
     */
    public function salvarEndereco(Request $request) : Endereco {
        $request->validate([
            'rua'    => 'required',
            'bairro' => 'required',
            'uf'     => 'required',
            'cidade' => 'required',
            'cep'    => 'required'
        ]);

        return $this->create([
            'rua'         => $request->rua,
            'bairro'      => $request->bairro,
            'cep'         => $request->cep,
            'cidade'      => $request->cidade,
            'complemento' => $request->complemento,
            'uf'          => $request->uf
        ]);
    }

    /**
     * 
     */
    public function pessoa() {
        return $this->hasOne(Pessoa::class);
    }
}
