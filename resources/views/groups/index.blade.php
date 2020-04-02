@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex w-100 justify-content-between">
                        <h3>Grupos</h3>
                        <a href="{{ route('groups.create')}}" class="btn btn-primary">Novo Grupo</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @if (count($groups) == 0)
                                    <span>Nenhum registro encontrado.</span>
                                @else
                                    <div class="list-group">
                                        @foreach($groups as $group)
                                            <a href="{{ route('groups.show',$group->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{$group->name}}</h5>
                                                    <small>{{$group->id}}</small>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
