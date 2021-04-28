@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Receita</div>

                <div class="card-body">
                    <form method="post" action="{{ route('Receita.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Seu Nome</label>
                            <input type="text" class="form-control" name="receita">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nome da sua Apertitosa Receita</label>
                            <input type="text" class="form-control" name="Cadastrar_Receita">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar Receita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection