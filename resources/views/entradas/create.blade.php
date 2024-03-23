@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ 'Adicionar Produtos' }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="/entradas/adicionar-item">
                    @method('POST')
                    @csrf

                    <div class="row">
                        @include('include.message')

                        <div class="col-md-4 mb-3">
                            <select name="produto" class="form-control">
                                <option value="" hidden>Produto</option>
                                @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->descricao }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('produto'))
                                <span class="text-danger">{{ $errors->first('produto') }}</span>
                            @endif
                        </div>


                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Adicionar</button>
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
        @foreach (session('produtos') as $kay=>$item)
        <tr>
            <th></th>
            <th>{{ $item['descricao'] }}</th>
            <th>{{ $item['quantidade'] }}</th>
            <td>
                <a href="/entradas/remover-item" class="btn btn-sm btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
@endsection
