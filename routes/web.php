<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Teachers Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::prefix('professor')->group(function () {
    /**
     * 
     *
     * @return
     */
    Route::get('/', 'Professor\ProfessorController@index')->name('professor');
    /**
     * 
     *
     * @return
     */
    Route::get('cadastrar', 'Professor\ProfessorController@cadastrar')->name('cadastrar-professor');
    /**
     * 
     *
     * @return
     */
    Route::get('editar/{matricula}', 'Professor\ProfessorController@editar')->name('editar-professor');
    /**
     * 
     *
     * @return
     */
    Route::get('relatorio', 'Professor\ProfessorController@relatorio')->name('relatorio-professor');
    /**
     * 
     *
     * @return
     */
    Route::get('get/professores/{idDisciplina}', 'Professor\ProfessorController@getProfessores')->name('get-professores');
    /**
     * 
     *
     * @return
     */
    Route::post('/', 'Professor\ProfessorController@store')->name('gravar-professor');
    /**
     * 
     *
     * @return
     */
    Route::get('disciplina', 'Professor\DisciplinaController@index')->name('disciplina');
    /**
     * 
     *
     * @return
     */
    Route::get('get/disciplinas/{idProfessor}', 'Professor\DisciplinaController@getDisciplinas')->name('get-disciplinas');
    /**
     * 
     *
     * @return
     */
    Route::get('get/turmas/{idDisciplina}/{idProfessor}', 'Professor\DisciplinaController@getTurmas')->name('get-turmas');
    /**
     * 
     *
     * @return
     */
    Route::get('disciplina/cadastrar', 'Professor\DisciplinaController@cadastrar')->name('cadastrar-disciplina');
    /**
     * 
     *
     * @return
     */
    Route::get('disciplina/editar/{id}', 'Professor\DisciplinaController@editar')->name('editar-disciplina');
    /**
     * 
     *
     * @return
     */
    Route::post('disciplinas', 'Professor\DisciplinaController@store')->name('gravar-disciplina');
    /**
     * 
     *
     * @return
     */
    Route::get('diario-de-classe', 'Professor\ProfessorController@diarioClasse')->name('diario-de-classe');
    /**
     * 
     *
     * @return
     */
    Route::get('get/professores/diario-de-classe/{idProfessor}/{idTurma}/{idDisciplina}', 'Professor\ProfessorController@gerarDiarioClasse')->name('gerar-diario-de-classe');
    /**
     * 
     *
     * @return
     */
    Route::post('teste', 'Professor\ProfessorController@teste')->name('professor-teste');
});

/*
|--------------------------------------------------------------------------
| Student's Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::prefix('aluno')->group(function () {
    /**
     * 
     *
     * @return
     */
    Route::get('/', 'Aluno\AlunoController@index')->name('aluno');
    /**
     * 
     *
     * @return
     */
    Route::get('cadastrar', 'Aluno\AlunoController@cadastrar')->name('cadastrar-aluno');
    /**
     * 
     *
     * @return
     */
    Route::get('editar/{matricula}', 'Aluno\AlunoController@editar')->name('editar-aluno');
    /**
     * 
     *
     * @return
     */
    Route::get('relatorio', 'Aluno\AlunoController@relatorio')->name('relatorio-aluno');
    /**
     * 
     *
     * @return
     */
    Route::get('get/{search}', 'Aluno\AlunoController@getAlunos')->name('get-aluno');
    /**
     * 
     *
     * @return
     */
    Route::get('get/responsaveis/{search}', 'Aluno\AlunoController@getResponsaveis')->name('get-responsaveis');
    /**
     * 
     *
     * @return
     */
    Route::post('teste', 'Aluno\AlunoController@teste')->name('aluno-teste');
});

/*
|--------------------------------------------------------------------------
| Employee's Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::prefix('funcionario')->group(function () {
    /**
     * 
     *
     * @return
     */
    Route::get('/', 'Funcionario\FuncionarioController@index')->name('funcionario');
    /**
     * 
     *
     * @return
     */
    Route::get('cadastrar', 'Funcionario\FuncionarioController@cadastrar')->name('cadastrar-funcionario');
    /**
     * 
     *
     * @return
     */
    Route::get('editar/{matricula}', 'Funcionario\FuncionarioController@editar')->name('editar-funcionario');
    /**
     * 
     *
     * @return
     */
    Route::get('relatorio', 'Funcionario\FuncionarioController@relatorio')->name('relatorio-funcionario');
    /**
     * 
     *
     * @return
     */
    Route::get('cargos', 'Funcionario\CargoFuncaoController@index')->name('cargo');
    /**
     * 
     *
     * @return
     */
    Route::get('cargos/cadastrar', 'Funcionario\CargoFuncaoController@cadastrar')->name('cadastrar-cargo');
    /**
     * 
     *
     * @return
     */
    Route::get('cargos/editar/{id}', 'Funcionario\CargoFuncaoController@editar')->name('editar-cargo');
    /**
     * 
     *
     * @return
     */
    Route::post('cargos', 'Funcionario\CargoFuncaoController@store')->name('gravar-cargo');
    /**
     * 
     *
     * @return
     */
    Route::post('/', 'Funcionario\FuncionarioController@store')->name('gravar-funcionario');
    /**
     * 
     *
     * @return
     */
    Route::post('teste', 'Funcionario\FuncionarioController@teste')->name('funcionario-teste');
});

/*
|--------------------------------------------------------------------------
|  Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::prefix('fornecedor')->group(function () {
    /**
     * 
     *
     * @return
     */
    Route::get('/', 'Fornecedor\FornecedorController@index')->name('fornecedor');
    /**
     * 
     *
     * @return
     */
    Route::get('cadastrar', 'Fornecedor\FornecedorController@cadastrar')->name('cadastrar-fornecedor');
    /**
     * 
     *
     * @return
     */
    Route::get('editar/{matricula}', 'Fornecedor\FornecedorController@editar')->name('editar-fornecedor');
    /**
     * 
     *
     * @return
     */
    Route::get('relatorio', 'Fornecedor\FornecedorController@relatorio')->name('relatorio-fornecedor');
    /**
     * 
     *
     * @return
     */
    Route::post('/', 'Fornecedor\FornecedorController@store')->name('gravar-fornecedor');
    /**
     * 
     *
     * @return
     */
    Route::post('teste', 'Fornecedor\FornecedorController@teste')->name('fornecedor-teste');
});

/*
|--------------------------------------------------------------------------
|  Routes
|--------------------------------------------------------------------------
|
|
|
*/
Route::prefix('turma')->group(function () {
    /**
     * 
     *
     * @return
     */
    Route::get('/', 'Turma\TurmaController@index')->name('turma');
    /**
     * 
     *
     * @return
     */
    Route::get('cadastrar', 'Turma\TurmaController@cadastrar')->name('cadastrar-turma');
    /**
     * 
     *
     * @return
     */
    Route::get('editar/{matricula}', 'Turma\TurmaController@editar')->name('editar-turma');
    /**
     * 
     *
     * @return
     */
    Route::get('relatorio', 'Turma\TurmaController@relatorio')->name('relatorio-turma');
    /**
     * 
     *
     * @return
     */
    Route::get('get/{turmas}', 'Turma\TurmaController@getTurmas')->name('get-turmas');
    /**
     * 
     *
     * @return
     */
    Route::post('/', 'Turma\TurmaController@store')->name('gravar-turma');
    /**
     * 
     *
     * @return
     */
    Route::post('teste', 'Turma\TurmaController@teste')->name('turma-teste');
});
