@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$client->name}}</h5>
                        <p class="card-text">{{$client->email}}</p>
                        @if ( Auth::user()->group->verifyRole("MANAGER_PHONES") )
                        <div style="position: absolute; top: 5px; right: 10px">
                            <a style="font-size: 20px;" href="{{ route('clients.edit', $client->id) }}" role="button"><i class="fas fa-user-edit"></i></a>
                            <a style="font-size: 20px; color: gray; margin-left: 5px" href="#" role="button" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></a>
                        </div>
                        @endif
                        <span>Telefones: </span>
                        <div class="list-group">
                            @foreach($client->phones as $phone)
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            {{ $phone->numberformated() }}
                                            <div>
                                                <a style="font-size: 20px;" href="tel:{{$phone->number}}" role="button"><i class="fas fa-phone-volume"></i></a>
                                                <a style="font-size: 20px; color: green; margin-left: 5px" href="http://api.whatsapp.com/send?1=pt_BR&phone=55{{$phone->number}}" role="button"><i class="fab fa-whatsapp"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja remover esse cliente?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">Sim</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
@endsection
