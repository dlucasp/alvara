@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Solicitações</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="get" action="{{route('solicitation.index')}}">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Procurar" name="q"
                                               value="{{request('q')}}">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Documento</th>
                                        <th>Protocolo</th>
                                        <th>Status</th>
                                        <th>Criado em</th>
                                        <th>Atualizado em</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($solicitations as $solicitation)
                                        <tr>
                                            <td>{{$solicitation->id}}</td>
                                            <td>{{$solicitation->name}}</td>
                                            <td>{{$solicitation->document}}</td>
                                            <td>{{$solicitation->protocol}}</td>
                                            <td>{{$solicitation->status}}</td>
                                            <td>{{$solicitation->created_at}}</td>
                                            <td>{{$solicitation->updated_at}}</td>
                                            <td><a href="{{route('solicitation.show', $solicitation)}}"
                                                   class="btn btn-link">Abrir</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                {{$solicitations->links()}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
