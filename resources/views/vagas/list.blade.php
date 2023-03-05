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

                    <form action="{{ url('vagas/add') }}" method="post">
                      @csrf
                      <label >Tipo:</label>
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
                  <br>
                  <h1>Lista de vagas</h1>
                  <table id="vagas-table" class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Status</th>
                        <th scope="col">Candidatos</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $vagas as $v )
                          <tr>
                            <td><p style="width: 110px;" class="tipo_vaga">{{ $tipos_vaga[$v->tipo]['tipo'] }}</p></td>
                            <td><p sstyle="width: 150px;">{{ $v->descricao }}</p></td>
                            <td><p style="width: 150px;">{{ ($v->status) ? 'Habilitada' : 'Desabilitada'}}</p></td>
                            <td>
                                  <a href="candidatos/{{ $v->id }}" class="btn btn-info">Candidatos</button>
                            </td>
                            <td>
                                  <a href="vagas/{{ $v->id }}/edit" class="btn btn-info">Editar</button>
                            </td>
                            <td>
                                  <form action="vagas/delete/{{ $v->id }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <button onclick="return confirm('Deseja realmente excluir?')"
                                  class="btn btn-danger">Deletar</button>
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
      $('#vagas-table').DataTable({
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

      $('#vagas-table tbody').on('click', 'a.btn-info', function () {
          var vagaId = $(this).data('id');
          window.location.href = '/vagas/' + vagaId + '/edit';
      });

      $('#vagas-table tbody').on('submit', 'form', function () {
          var vagaId = $(this).data('id');
          if (confirm('Deseja realmente excluir?')) {
              $.ajax({
                  url: '/vagas/delete/' + vagaId,
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