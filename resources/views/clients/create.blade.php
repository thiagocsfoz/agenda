@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Novo Cliente</div>

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
                            <form method="post" action="{{ route('clients.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" class="form-control" name="name"/>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="text" class="form-control" name="email"/>
                                </div>
                                <b>Telefones:</b>
                                <div id="phones">
                                    <a style="font-size: 20px;" href="#" onclick="addPhone()" role="button"><i class="fas fa-plus"></i></a>
                                    <div class="form-group phone-group">
                                        <label for="email">Numero:</label>
                                        <input type="text" class="form-control" name="phones[]"/>
                                        <a style="font-size: 20px;" href="#" onclick="removePhone(event)" role="button"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Adicionar Cliente</button>
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
