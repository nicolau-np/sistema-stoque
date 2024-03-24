@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $menu }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                @include('include.message')
                <form action="/vendas/search" method="POST">
                    <div class="row mb-4">

                        <div class="col-md-8">
                            <input type="text" wire:model="text_search" class="form-control" id=""
                                placeholder="Pesquisar..." />
                        </div>
                        <div class="col-md-1 mr-3">
                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                        </div>
                        <div class="col-md-2">
                            <a href="/vendas/create" class="btn btn-success">Nova</a>
                        </div>

                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Data do movimento</th>
                                <th>Cliente</th>
                                <th>Método de Pagamento</th>
                                <th>Total de Produtos</th>
                                <th>Total da Venda(Akz)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendas as $venda)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-Y', strtotime($venda->data_movimento)) }}</td>
                                    <td>{{ $venda->contacto->descricao }}</td>
                                    <td>{{ $venda->metodo_pagamento }}</td>
                                    <td>{{ $venda->itemStoque->count() }}</td>
                                    <td>{{ number_format($venda->total_pagar, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="/vendas/{{ $venda->id }}" class="btn btn-primary">Detalhes</a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="paginate">
                    {{ $vendas->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
