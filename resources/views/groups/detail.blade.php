@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$group->name}}</h5>
                        <div style="position: absolute; top: 5px; right: 10px">
                            <a href="/groups/{{$group->id}}/new-user" class="btn btn-primary">Adicionar Usuário</a>
                        </div>
                        <b>Permissões: </b>
                        <div class="list-group">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" disabled class="form-check-input" {{ $group->verifyRole('VIEW_PHONES') ? 'checked' : '' }} name="VIEW_PHONES">
                                    <label class="form-check-label" for="exampleCheck1">Visualizar Telefones</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" disabled class="form-check-input" {{ $group->verifyRole('MANAGER_PHONES') ? 'checked' : '' }} name="MANAGER_PHONES">
                                    <label class="form-check-label" for="exampleCheck1">Editar / Excluir Telefone</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" disabled class="form-check-input" {{ $group->verifyRole('VIEW_LOGS') ? 'checked' : '' }} name="VIEW_LOGS">
                                    <label class="form-check-label" for="exampleCheck1">Visualizar Log de Atividades (todos os usuários)</label>
                                </div>
                            </div>
                        </div>
                        <b>Usuários: </b>
                        <div class="list-group">
                            @if (count($group->users) == 0)
                                <span>Nenhum usuário cadastrado.</span>
                            @else
                                <div class="list-group">
                                    @foreach($group->users as $user)
                                        <a href="{{ route('clients.show',$user->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{$user->name}}</h5>
                                                <small>{{$user->id}}</small>
                                            </div>
                                            <p class="mb-1">{{$user->email}}</p>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
