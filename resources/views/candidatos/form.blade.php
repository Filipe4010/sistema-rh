@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('contas') }}">Voltar</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                @if( Request::is('*/edit'))
                    <form action="{{ url('candidatos/update') }}/{{ $candidato->id }}" method="post">
                        @csrf
                        <div class="form-group">
                          <label >Nome:</label>
                          <input value="{{ $candidato->nome }}" type="text" name="nome" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label >Resumo:</label>
                            <input value="{{ $candidato->resumo }}" type="text" name="resumo" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label >Email:</label>
                            <input value="{{ $candidato->email }}" type="text" name="email" class="form-control" required>
                        </div>       
                        <br>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                @else
                    <form action="{{ url('candidatos/add') }}" method="post">
                        @csrf
                        <div class="form-group">
                          <label >Nome:</label>
                          <input type="text" name="nome" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label >Resumo:</label>
                            <input type="text" name="resumo" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label >Email:</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>       
                        <br>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection