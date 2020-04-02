@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Novo Grupo</div>

                    <div class="card-body">
                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            <form method="post" action="{{ route('groups.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" class="form-control" name="name"/>
                                </div>
                                <b>Permissões:</b>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="VIEW_PHONES">
                                        <label class="form-check-label" for="exampleCheck1">Visualizar Telefones</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="MANAGER_PHONES">
                                        <label class="form-check-label" for="exampleCheck1">Editar / Excluir Telefone</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="VIEW_LOGS">
                                        <label class="form-check-label" for="exampleCheck1">Visualizar Log de Atividades (todos os usuários)</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Adicionar Grupo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addPhone()
        {
            let input = "<div class=\"form-group phone-group\">\n" +
                "<label for=\"email\">Numero:</label>\n" +
                "<input type=\"text\" class=\"form-control\" name=\"phones[]\"/>\n" +
                "<a href=\"#\" onclick=\"removePhone(event)\" role=\"button\"><i class=\"fas fa-trash\"></i></a>" +
                "</div>";

            $("#phones").append(input);
        }

        function removePhone(event)
        {
            $(event.target).parent().parent().remove();
        }
    </script>
@endsection
