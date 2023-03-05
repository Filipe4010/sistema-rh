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
                    <form action="{{ url('vagas/update') }}/{{ $vaga->id }}" method="post">
                        @csrf
                        <label >Status:</label>
                        <select  value="{{ $vaga->nome }}" name="tipo" class="form-select" aria-label="Default select example" required>
                            <option value="">Selecione</option>
                            @foreach( $tipos_vaga as $key => $t )
                                <option <?php echo ($vaga->tipo == $key) ? 'selected' : ''; ?> value="{{$t['id']}}">{{$t['tipo']}}</option>
                            @endforeach
                        </select> 
                        <div class="form-group">
                            <label >Descrição:</label>
                            <input value="{{ $vaga->descricao }}" type="text" name="descricao" class="form-control" required>
                        </div>
                        
                        <label >Status:</label>
                        <select value="{{ $vaga->status }}" name="status" class="form-select" aria-label="Default select example" required>
                            <option value="" >Selecione</option>
                            <option value="1" <?php echo ($vaga->status == 1) ? 'selected' : ''; ?>>Habilitada</option>
                            <option value="0" <?php echo ($vaga->status == 0) ? 'selected' : ''; ?>>Desabilitada</option>
                        </select> 
                        <br>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                @else
                    <form action="{{ url('vagas/add') }}" method="post">
                        @csrf
                        <label >Status:</label>
                        <select name="tipo" class="form-select" aria-label="Default select example" required>
                            <option value="" selected>Selecione</option>
                            <option value="1" >CLT</option>
                            <option value="2">Pessoa Jurídica</option>
                            <option value="3">Freelancer</option>
                        </select> 

                        <div class="form-group">
                            <label >Descrição:</label>
                            <input type="text" name="descricao" class="form-control" required>
                        </div>
                        
                        <label >Status:</label>
                        <select name="status" class="form-select" aria-label="Default select example" required>
                            <option value="" >Selecione</option>
                            <option value="1" selected>Habilitada</option>
                            <option value="0">Desabilitada</option>
                        </select> 
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