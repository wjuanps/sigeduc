<?php

namespace App\Models;

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
     */
    public function endereco() {
        return $this->belongsTo('App\Models\Endereco');
    }
    
    /**
     * 
     */
    public function professor() {
        return $this->hasOne('App\Models\Professor');
    }
}
