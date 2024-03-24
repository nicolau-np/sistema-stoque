@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ 'Definir Contacto' }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="/compras">
                    @method('POST')
                    @csrf

                    <div class="row">
                        @include('include.message')

                        <div class="col-md-4 mb-3">
                            <select name="contacto" class="form-control">
                                <option value="" hidden>Fornecedor</option>
                                @foreach ($contactos as $contacto)
                                    <option value="{{ $contacto->id }}">{{ $contacto->descricao }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('contacto'))
                                <span class="text-danger">{{ $errors->first('contacto') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Finalizar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('lista_de_produtos'))
                                @foreach (session('lista_de_produtos') as $kay => $item)
                                    <tr>
                                        <th>{{ $item['produto_id'] }}</th>
                                        <th>{{ $item['descricao'] }}</th>
                                        <th>{{ $item['quantidade'] }}</th>
                                        <td>
                                            <a href="/compras/remover-item/{{ $item['produto_id'] }}" class="btn btn-sm btn-danger">Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
