@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Receitas</div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Receitas Cadastradas</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>    

                        <tbody>
                         
                        </tbody>
                    </table>

                    <nav>
                        <ul class="pagination">
                            <li class="page-item"> <a class="page-link" href="#">Voltar</a></li>

                            
                            <li class="page-item"><a class="page-link" href="#">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
