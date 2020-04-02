@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex w-100 justify-content-between">
                        <h3>Log de Atividades</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableFixHead">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Model</th>
                                    <th>Action</th>
                                    <th>User</th>
                                    <th>Time</th>
                                    <th>Old Values</th>
                                    <th>New Values</th>
                                    <th>Url</th>
                                    <th>Ip_adrress</th>
                                    <th>Navegador</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($audits as $audit)
                                    <tr>
                                        <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>
                                        <td>{{ $audit->event }}</td>
                                        <td>{{ $audit->user ? $audit->user->name : ''}}</td>
                                        <td>{{ $audit->created_at }}</td>
                                        <td>
                                            <table class="table table-bordered table-hover" style="width:100%">
                                                @foreach($audit->old_values as $attribute  => $value)
                                                    <tr>
                                                        <td><b>{{ $attribute  }}</b></td>
                                                        <td>{{ $data }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered table-hover" style="width:100%">
                                                @foreach($audit->new_values as  $attribute  => $data)
                                                    <tr>
                                                        <td><b>{{  $attribute  }}</b></td>
                                                        <td>{{ $data }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>{{ $audit->url }}</td>
                                        <td>{{ $audit->ip_address }}</td>
                                        <td>{{ $audit->user_agent }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

