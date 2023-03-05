@extends('layouts.app')

@section('content')

<style>
  .dataTables_length select {
    width: 70px;
    margin-right: 10px;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    border: 1px solid #ced4da;
  }

  .dataTables_filter input {
    width: 150px;
    margin-right: 10px;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    border: 1px solid #ced4da;
  }
  .dataTables_paginate .paginate_button {
    display: inline-block;
    padding: 5px 10px;
    margin-right: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }

  .dataTables_paginate .paginate_button.current {
    background-color: #337ab7;
    color: #fff;
    border-color: #337ab7;
  }

  .dataTables_paginate .paginate_button.disabled {
    opacity: 0.5;
    pointer-events: none;
  }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <form action="{{ route('candidatos.add', ['id' => $vaga->id]) }}" method="POST">
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
                    <button <?php echo ($vaga->status == 0) ? 'disabled' : '' ?> type="submit" class="btn btn-primary">Cadastrar</button>
                  </form>

                  <br>
                  <h1>Lista de Candidatos</h1>
                  <table id="candidatos-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Resumo</th>
                            <th scope="col">Email</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Deletar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $candidatos as $c )
                            <tr>
                                <td><p style="width: 110px;" class="tipo_candidato">{{ $c->nome }}</p></td>
                                <td><p sstyle="width: 150px;">{{ $c->resumo }}</p></td>
                                <td><p style="width: 150px;">{{ $c->email }}</p></td>
                                <td>
                                    <a href="/candidatos/{{ $c->id }}/{{ $vaga->id }}/edit" class="btn btn-info" data-id="{{ $c->id }}">Editar</a>
                                </td>
                                <td>
                                    <form action="/candidatos/delete/{{ $c->id }}" method="post" data-id="{{ $c->id }}">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('Deseja realmente excluir?')" class="btn btn-danger">Deletar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>





  
@section('scripts')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#candidatos-table').DataTable({
      "paging": true,
      "pageLength": 20,
      "ordering": true,
      "searching": true,
      "lengthChange": false, // desabilita o campo "Show entries"
      "language": {
        "search": "Busca:",
        "info": "Exibindo de _START_ a _END_ de _TOTAL_ registros"
      }
    });

    $('#candidatos-table tbody').on('click', 'a.btn-info', function () {
        var candidatoId = $(this).data('id');
        window.location.href = '/candidatos/' + candidatoId + '/{{ $vaga->id }}/edit';
    });

    $('#candidatos-table tbody').on('submit', 'form', function () {
        var candidatoId = $(this).data('id');
        if (confirm('Deseja realmente excluir?')) {
            $.ajax({
                url: '/candidatos/delete/' + candidatoId,
                type: 'DELETE',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(result) {
                    window.location.reload();
                }
            });
        }
        return false;
    });
});
</script>
@endsection

@endsection