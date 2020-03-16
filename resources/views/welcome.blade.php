@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary mb-3">
                    <div class="card-header">Consultar</div>

                    <div class="card-body">
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
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="card border-primary mb-3" method="post" action="{{route('solicitation.store')}}">
                    @csrf
                    <div class="card-header {{$errors->any() ? '': ''}} ">Solicitar</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                {{--                                @if ($errors->any())--}}
                                {{--                                    <div class="alert alert-danger">--}}
                                {{--                                        <ul>--}}
                                {{--                                            @foreach ($errors->all() as $error)--}}
                                {{--                                                <li>{{ $error }}</li>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div><br/>--}}
                                {{--                                @endif--}}
                            </div>
                            <div class="col-12 form-group">
                                <label class="form-control-label" for="inputSuccess1">Documento</label>
                                <input type="text" value="{{old('document')}}"
                                       class="form-control {{$errors->has('document') ? 'is-invalid' : ''}}"
                                       name="document">
                                @if($errors->has('document'))
                                    <div class="invalid-feedback">Campo obrigatório</div>
                                @endif
                            </div>

                            <div class="col-12 form-group">
                                <label class="form-control-label" for="inputSuccess1">Nome</label>
                                <input type="text" value="{{old('name')}}"
                                       class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">Campo obrigatório</div>
                                @endif
                            </div>

                            <div class="col-12 form-group">
                                <label class="form-control-label" for="inputSuccess1">Nascimento</label>
                                <input type="date" value="{{old('birthday')}}"
                                       class="form-control {{$errors->has('birthday') ? 'is-invalid' : ''}}"
                                       name="birthday">
                                @if($errors->has('birthday'))
                                    <div class="invalid-feedback">Campo obrigatório</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Submeter</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
