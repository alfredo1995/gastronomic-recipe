@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Receitas<a href="{{ route('Receita.create')}}" class="float-right">Nova Receita</a></div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Receitas Cadastradas</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>    

                        <tbody>
                            @foreach($receitas as $t )
                                <tr>    
                                    <th scope="row">{{ $t->id }}</th>
                                    <td>{{ $t->receita }}</td>
                                    <td>{{ $t->Cadastrar_Receita }}</td>
                                    <td><a href="{{ route('Receita.edit', $t->id ) }} ">Editar</a></td>
                                    <td> 
                                    <form id="form_{{$t->id}}" method="post" action="{{ route('Receita.destroy',  $t->id ) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <a href="#" onclick="document.getElementById('form_{{$t->id}}').submit()">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                 
                    
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"> <a class="page-link" href="{{ $receitas->previousPageUrl() }}">Voltar</a></li>

                            

                            <li class="page-item"><a class="page-link" href="{{ $receitas->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection