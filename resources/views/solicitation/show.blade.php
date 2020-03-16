@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif

                @if(session()->get('success'))
                    <div class="alert alert-success mb-5">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card border-primary mb-3">
                    <div class="card-header">{{$solicitation->protocol}} - {{$solicitation->name}}
                        ( {{$solicitation->status}} )
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if(auth()->user()->nivel =='user')
                                <form method="post" class="col-12"
                                      action="{{route('solicitation.uploadDocument', [$solicitation])}}"
                                      enctype="multipart/form-data">
                                    <div class="row">
                                        @csrf
                                        <div class="form-group col-12">
                                            <label>Anexo Documento</label>
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                        <div class="form-group col-12">
                                            <button type="submit" class="btn btn-info">Enviar</button>
                                        </div>
                                    </div>
                                </form>

                            @else
                                <form method="post"
                                      action="{{route('solicitation.addAnnotation', [$solicitation])}}"
                                      class="col-12">
                                    <div class="row">
                                        @csrf
                                        <div class="form-group col-8">
                                            <label>Anotação</label>
                                            <textarea class="form-control" name="annotation"></textarea>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                @foreach(['ABERTO', 'PROCESSANDO', 'FINALIZADO', 'CANCELADO'] as $key => $status)
                                                    <option
                                                        {{$solicitation->status == $status ? 'selected' : ''}} value="{{$status}}">
                                                        {{$status}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <button type="submit" class="btn btn-info">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            @endguest
                        </div>

                        <div class="row mt-5">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Anotação</th>
                                    <th>Status</th>
                                    <th>Criado em</th>
                                    <th>Usuário</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitation->movimentations as $movimentation)
                                    <tr>
                                        <td>{{$movimentation->id}}</td>
                                        <td>{{$movimentation->annotation}}</td>
                                        <td>{{$movimentation->status}}</td>
                                        <td>{{$movimentation->created_at}}</td>
                                        <td>{{@$movimentation->user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-5">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Link</th>
                                    <th>Criado em</th>
                                    <th>Visualizado</th>
                                    <th>Aprovado</th>
                                    @if(auth()->user()->nivel =='admin')
                                        <th>Ação</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($solicitation->documents as $document)
                                    <tr>
                                        <td>{{$document->id}}</td>
                                        <td>
                                            <a href="{{route('solicitation.documents.download', [$solicitation, $document])}}">Visualizar</a>
                                        </td>
                                        <td>{{$document->created_at}}</td>
                                        <td>{{$document->download_date}}</td>
                                        <td>{{$document->approved ? "Aprovado" : (is_null($document->approved) ? "Em processo" : "Com erro")}}</td>
                                        @if(auth()->user()->nivel == 'admin')
                                            <td>
                                                @if(is_null($document->approved))
                                                    <form method="post"
                                                          action="{{route('solicitation.documents.approve', [$solicitation, $document])}}">
                                                        @csrf
                                                        <button type="submit" value="1" name="approve"
                                                                class="btn btn-outline-success btn-sm">Aprovar
                                                        </button>
                                                        <button type="submit" value="0" name="approve"
                                                                class="btn btn-outline-danger btn-sm">Reprovar
                                                        </button>
                                                    </form>
                                                    @csrf
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
