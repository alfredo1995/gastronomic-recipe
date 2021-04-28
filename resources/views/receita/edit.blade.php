@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atualizar Receita</div>

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
            </div>
        </div>
    </div>
</div>
@endsection