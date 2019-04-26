<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @author Juan Soares
 */
class Escola extends Model {
    
    /**
     * 
     */
    public function endereco() {
        return $this->belongsTo(Endereco::class);
    }
}
