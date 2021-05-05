Criação de API para um site de receitas gastronômicas. <br>
 
API contem um sistema de autenticação completo (login, logoff e register). <br>
Após logado o usuário cadastrar novas receitas além de visualizar, editar ou excluir receitas já existentes.  

Instalações Necessárias:
    
    --->  PHP 8 + COMPOSER + NODEJS +  XAMPP + MYSQL WORKBENCH

Conhecimentos Necessário: 

    --->  HTML5 + PHP +  SQL + POO + LARAVEL + FRAMEWORK BOOTSRAP (CSS) 


1) Iniciar o projeto 
       
       - composer create-project --prefer-dist Laravel/Laravel receita_gastronomica
     
2) Configurar o NODEJS para usar o pacote UI do Laravel
       
       -  composer require laravel/ui^3.2
      
3) Criar aplicação Front End do Sistema de Autenticação Web ( Bootstrap, Vuejs ou React )
       
       -  php artsisan ui <front-end> --auth
       
4) Instalar NPM para as dependências Front End do Scaffold
       
       - npm install
       - npm run dev
       - npm instal resolver-url-loader@^3.1.2 --salve--dev --legacy--peerdeps
       - npm run dev
       
5) Criar o banco de dados
       
       - create database rg;
       
6) Conxexão com banco de dados
       
       -DB_CONNECTION=mysql
       -DB_HOST=127.0.0.1
       -DB_PORT=3306
       -DB_DATABASE=rg
       -DB_USERNAME=root
       -DB_PASSWORD=7070
       
       - php artisan migrate
        
7)  Criação do Models e o Controller com resource (função estática como o método get)   
      
        -php artisan make:controller --resource ReceitaController --model=Receita
       
8) Implementando as middelware Auth
       
       - Auth::routes();

       - Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
       
9) Implementando mapeamento das rotas para o Controller

       - Route::resource('Receita', 'App\http\Controllers\ReceitaController')->parameters(['Receita' => 'id']); 
          
10) Implementando metódo p/ verificar a autenticação
        
        - public funtion __construct(){ $this->middelware('auth'); }
        
11) Cadastrar novas receitas
        
        - public function create()  { return view ('receita.create');  }
        
12) Criar a view create
    
         - resource>views>receita>create
         - copiar e colar conteudo do home.blade.php como paramentro e fazer as alterações
        
14) Personalizar Form do Bootstrap 

         - copiar codigo de form no bootstrap e personalizar
         - Manter a class form-label
         - tipo do imput "text"
         - nome do input "receita"
         - button do tipo subimit
         - form methodo="post"
         - action="receita.store" 
         - adicionar token @csrf no form

14) Disparando os dados do formulario para o metodo Store receber request e armazenar os dados no banco
         
          -  public function store(Request $request) {  request->all();  }

15) Implementar uma tabela no banco para receber os dados do metodo store

         - php artisan make:migration create_receitas_table
      
16) Criar as colunas e os tipos na database para migration 

            public function up()  {
       
            Schema::create('receitas', function (Blueprint $table) {
            
                $table->id();
                $table->integer('user_id'); 
                $table->string('receita', 200);
                $table->string('Cadastrar_Receita', 500);
                $table->timestamps();
            });
            }
    
    
            php artisan migrate
            
17) Receber e Armazenar os dados no banco com o metodo store ::

          - public function store(Request $request) {
                  $dados = $request->all();        
                  $dados['user_id'] = auth()->user()->id;   
                  
                  
                  $Receita = Receita::create($dados);
                  
                  return $this->index();
        }
        
        
18) Methodo show recebendo objeto Receita com o id instaciado 
        
        - public function show(Receita $receita) { }


18) Habilitar no moldels os atributos que serão preenchidos
        
         - protectd $table = Receita;
         - protected $fillable=['receita', 'Cadastrar_Receita', 'user_id'];


        
19) Associando o usuário a receita criada
    
        -  php artisan make:migration alter_table_receitas_relacionamento_users
                 
        public function up () { 
        
               schema::table('receitas', function(Blueprint $table) { 
                  $table->UnsignedBigInteger('user_id')->nullable()->after('id');
                  $table->foreign('user_id')->references('id')->on('users'); });

        }

        
        -php artisan migrate
                       

20) Criar array p/ recuperar os atributos do $request all e adiconar esse array um indice p/ receber o id do usuario autenticado
               
        
        - public function store(Request $request) {
         
                  $dados = $request->all();        
                  $dados['user_id'] = auth()->user()->id;   
                  
                  $Receita = Receita::create($dados);                  
                  return $this->index();
        }
 
 
21) Listando dos registro da Receitas
        
        -   public function index()  { return view('receita.index');  
        
22) Criar a view index no repositorio receita
        
        - resource>views>receita> index.blade.php        
        - copiar o conteudo da view create e colar na index.blade.php para fazer as respectivas alterações
        - Pegar um exemplo de tabela no site do Bootstrap e ajustar a tabela
        
                                <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Receita</th>
                                <th scope="col">Receita_Cadastradas</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>    

                        <tbody>
                                    <tr>    
                                    <th scope="row">1</th>
                                    <td></td>
                                    <td></td>                                    
                                    </tr>                            
                        </tbody>
                    </table>
        
 23) Criar Variavel para Recuperar todas as receitas do user_id autenticado
    
               $user_id = auth()->user()->id;        
               $receitas = Receita::where('user_id', $user_id)->get();
       
               return view('receita.index', compact('receitas'));  
        
24) Incluir um @foreach recuperando $receitas as $t na view index.blade.php


                  <tbody>
                            @foreach($receitas as $t )
                                <tr>    
                                    <th scope="row">1</th>
                                    <td></td>
                                    <td></td>                                                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


25) Exibir os dados nos campos atribuidos

                    <tbody>
                            @foreach($receitas as $t )
                                <tr>    
                                    <th scope="row">{{ $t->id }}</th>
                                    <td>{{ $t->receita }}</td>
                                    <td>{{ $t->Cadastrar_Receita }}</td>                                                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


26) Implementação da paginação dos registro do metodo index()

                    $user_id = auth()->user()->id;        
                    $receitas = Receita::where('user_id', $user_id)->paginate(10);
       
                    return view('receita.index', compact('receitas'));  
                    
                    
                    
                    Explorar a $receita recebe um array de objetos do tipo Receita com os parametro de paginação index.blade
                    
                        
                    </table>                   
                    

                    <nav>
                        <ul class="pagination">
                            <li class="page-item"> <a class="page-link" href="#">Voltar</a></li>

                            
                            <li class="page-item"><a class="page-link" href="#">Avançar</a></li>
                        </ul>
                    </nav>
                    
27) Implementar os links na pagianação

                    <nav>
                        <ul class="pagination">
                            <li class="page-item"> <a class="page-link" href="{{ $receitas->previousPageUrl() }}">Voltar</a></li>

                            <li class="page-item"> <a class="page-link" href="#">1</a></li>

                            <li class="page-item"><a class="page-link" href="{{ $receitas->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                    </nav>
                    
                    
28) Modificar a rota padrão home da aplicação

            -App>Providers> RouteServiceProvider.php
            
            public const HOME = '/receita';
          
29) Atualizando Registro das Receitas

        - incluir mais uma coluna <th> e um <td> para o link. index.blade
        - <td><a href="">Editar</a></td>
     
30) Implementar o link de Edição já passando o paramentro do id da receita
        
        - <td><a href="{{ route('Receita.edit', $t->id ) }} ">Editar</a></td>
        
31) Return na rota já passando os parametros
        
        -   public function edit(int $id)    {  return view('receita.edit', compact('receita'));  

32) Criar a view edit.blade.php           
        
        - copiar todo conteudo da view create.blade como parametro para personalizar
        - Ajustar o titulo
        - action direcionar o formulario via metodo post para Receita.update passando o id da receita
        - determinar o @metodo('PUT') para a rota update
        - implementar o value dos campos

         <div class="card-body">

                    <form method="post" action="{{ route('Receita.update',  $receita->id) }}"> 
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Receita</label>
                            <input type="text" class="form-control" name="receita" value="{{$receita->receita}}">
                        </div>
                        <div class="mb-3
                            <label class="form-label">Cadastrar_Receita</label>
                            <input type="text" class="form-control" name="Cadastrar_Receita" value="{{$receita->Cadastrar_Receita}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form> 
                </div>
                
31) Disparar a requisição update
        
                public function update(Request $request, int $id)   {
                          
                  $receita->update($request->all());        
                  return redirect()->route('Receita.index');
                  
32) Validando se a receita pertence ao usuario antes de habilitar a edição
                
                - criar uma camada um controller
                - criar a view acesso_negado.blade.php
                - Resource>Views> acesso_negado.blade.php
                - copiar todo conteudo da view home.blade.php e colar na view acesso_negado.blade.php 

                        @extends('layouts.app')

                        @section('content')
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">{{ __('Acesso Negado') }}</div>

                                        <div class="card-body">
                                            Você não tem acesso a esse recurso
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endsection


33) metodo edit recuperar o atributo e fazer uma condição
                    
                        $receita = Receita::findOrFail($id);
                              if(!$receita->user_id == auth()->user()->id) {
                        return view('acesso-negado');   }
                        
                        $receita->update($request->all());        
                        return redirect()->route('Receita.index');
                        
34) Relacionamentos entre tabelas no Models
            
            Receita.php
            
            - relacionamento de muitos para um
            
              public function user() {            
             return $this->belongsTo(User::class);    }
             
             
           User.php
           
           - relacionamento de um para muitos
       
           public function receitas(){
           return $this->hasMany(Receita::class);    }
           
           
           ReceitaController.php
           
           use App\Models\User;
           
           
35) Remover Registro
            
            - incluir mais uma coluna <th> e um <td> para o link Excluir. index.blade
            - <td><a href="">Excluir</a></td>
            
36) Implementar o form com todas as configuraçoes para o Request de remoção


            - action direcionar o formulario via metodo post para Receita.destroy passando paramentro e o id da receita
            - determinar o @metodo('PUT') para a rota
            - passar o token @crsf
            - implementar o value dos campos

           <td> 
             <form id="form_{{$t->id}}" method="post" action="{{ route('Receita.destroy',  $t->id ) }}">
             @method('DELETE')
             @csrf
             </form>
             <a href="#">Excluir</a>             
           </td>
           
           - incluir evento OnClick no link excluir
           - selecionar o formulario pelo respectivo id
           - executar o DOM para selecionar esse elemento html  
           - disparar o evento envio atrabes do metodo submit

             </form>
                <a href="#" onclick="document.getElementById('form_{{$t->id}}').submit()">Excluir</a>
             </td>            

37) Controller para permitir q a receita seja excluida apenas pelo usuario

          - recuperando o user id da tarefa q está sendo injetado no metodo e comparando com o id do usuario
          - recuperar a tarefa e executar o metodo delete
          - return redirect para rota index (listagem de receita )
    
           public function destroy(Receita $receita, int $id)  {
          
          $receita = Receita::findOrFail($id);
          if(!$receita->user_id == auth()->user()->id) {
            return view('acesso-negado');        }
            
           
          $receita->delete();
          return redirect()->route('Receita.index'); }
        
        
38) Implementando Menu de Navegação
        
        - criar um link para view de cadastro de novas tarefas
        - possionar o link float-right
        
        index.blade.php 
        
        <div class="card-header">Receitas<a href="{{ route('Receita.create')}}" class="float-right">Nova Receita</a></div>
        
        - criar um link para acessar a relação de receitas 
        - modificar a navegação do layout padrão
        - Resource>Views>Layouts> app.blade.php

                  @endif
                @else
                    <li class="navbar-item">
                       <a href="{{ route('Receita.index') }}" class="nav-link">Receitas</a>
                    </li>
        
       
           
           
<br><br><br><br> <br>

Rotas criadas!

GET|HEAD  | Receita                | Receita.index    | App\http\Controllers\ReceitaController@index                           | web    <br>
POST      | Receita                | Receita.store    | App\http\Controllers\ReceitaController@store                           | web    <br>
GET|HEAD  | Receita/create         | Receita.create   | App\http\Controllers\ReceitaController@create                          | web    <br>
GET|HEAD  | Receita/{id}           | Receita.show     | App\http\Controllers\ReceitaController@show                            | web    <br>
PUT|PATCH | Receita/{id}           | Receita.update   | App\http\Controllers\ReceitaController@update                          | web    <br>
DELETE    | Receita/{id}           | Receita.destroy  | App\http\Controllers\ReceitaController@destroy                         | web    <br>
GET|HEAD  | Receita/{id}/edit      | Receita.edit     | App\http\Controllers\ReceitaController@edit                            | web    <br>
       
->Documentação em construção ;) 
