<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;
use App\Models\User;

class ReceitaController extends Controller
{
   
    
    /**
     * Display a listing of the resource.
     *z 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        //criar variavel user_id com o metodo auth ->executando o metodo user, recuperando o atributo id
        $user_id = auth()->user()->id;
        // variavel recebe where (para recuperar todas as receitas que o user_id seja user_id autenticado
        $receitas = Receita::where('user_id', $user_id)->paginate(4);
        //rertornando a view index dentro do reporsitorio receita
        return view('receita.index', compact('receitas'));  

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // retorna a view create
        return view ('receita.create'); 
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //array para pegar todos os dados do $request
        $dados = $request->all();        
        ///adicionar a esse array $dados um indice [user_id] = que vai receber o id do usuario autenticado auth()->user()->id; 
        $dados['user_id'] = auth()->user()->id;              
        $Receita = Receita::create($dados);
        return $this->index();

        //$user = User::find(auth()->user()->id);
        //return $user 
         
       }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function show(Receita $receita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $receita = Receita::findOrFail($id);
        return view('receita.edit', compact('receita'));  
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $receita = Receita::findOrFail($id);
        if(!$receita->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }
        //recuprado o objeto $receita injetado o metodo updtade , passando os dados do $request para fazer o update dos dados
        $receita->update($request->all());
        //retornando a rota receita.show e visualizar o resultado
        return redirect()->route('Receita.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receita  $receita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receita $receita, int $id)
    {
        //recuperando o user id da tarefa q está sendo injetado no metodo e comparando com o id do usuario
        $receita = Receita::findOrFail($id);
        if(!$receita->user_id == auth()->user()->id) {
            return view('acesso-negado');
        }
        $receita->delete();
        return redirect()->route('Receita.index');
    }
}
