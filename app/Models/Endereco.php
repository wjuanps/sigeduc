<?php

namespace App\Models;

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
     */
    public function pessoa() {
        return $this->hasOne('App\Models\Pessoa');
    }
}
