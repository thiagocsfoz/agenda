@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex w-100 justify-content-between">
                        <h3>Clientes</h3>
                        <a href="{{ route('clients.create')}}" class="btn btn-primary">Novo Cliente</a>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/search">
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-sm-12 input-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" class="form-control" value="{{$search}}" name="search" placeholder="Buscar clientes">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="col-sm-12">
                            @if(session()->get('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                @if (count($clients) == 0)
                                    <span>Nenhum registro encontrado.</span>
                                @else
                                    <div class="list-group">
                                            @foreach($clients as $client)
                                                <a href="{{ route('clients.show',$client->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1">{{$client->name}}</h5>
                                                        <small>{{$client->id}}</small>
                                                    </div>
                                                    <p class="mb-1">{{$client->email}}</p>
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
