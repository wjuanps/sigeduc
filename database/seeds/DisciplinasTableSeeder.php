<?php

use Illuminate\Database\Seeder;
use App\Models\Disciplina;

/**
 * 
 * @author Juan Soares
 */
class DisciplinasTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Disciplina::create([
            'disciplina' => 'Língua Portuguesa',
            'descricao'  => 'Língua Portuguesa'
        ]);
        Disciplina::create([
            'disciplina' => 'Matemática',
            'descricao'  => 'Matemática'
        ]);
        Disciplina::create([
            'disciplina' => 'Física',
            'descricao'  => 'Física'
        ]);
        Disciplina::create([
            'disciplina' => 'História',
            'descricao'  => 'História'
        ]);
        Disciplina::create([
            'disciplina' => 'Biologia',
            'descricao'  => 'Biologia'
        ]);
    }
}
