@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $menu }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            @include('include.message')

            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="col-title mb-2"><span class="bold">Data de Movimento:</span>
                            {{ date('d-m-Y', strtotime($venda->data_movimento)) }}</div>
                        <div class="col-title mb-2"><span>Cliente:</span> {{ $venda->contacto->descricao }}</div>
                        <div class="col-title mb-2"><span>Total de Produtos:</span>
                            {{ $venda->itemStoque->count() }}</div>
                            <div class="col-title mb-2"><span>Total Pago:</span>
                                {{ number_format($venda->total_pagar, '2',',','.') }}</div>

                    <div class="table-responsive lista_de_produtos">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($venda->itemStoque as $item)
                                        <tr>
                                            <th>{{ $item->produto_id }}</th>
                                            <th>{{ $item->produto->descricao }}</th>
                                            <th>{{ $item->quantidade }}</th>
                                            <th>{{ number_format($item->preco_unitario,2,',','.') }}</th>
                                            <th>{{ number_format(($item->quantidade*$item->preco_unitario),2,',','.') }}</th>

                                        </tr>
                                    @endforeach

                            </tbody>
                        </table>
                    </div>
                        </div>
                    @if (Auth::user()->nivel_acesso == 'admin')
                        <div class="card-footer">
                            <form action="/vendas/{{ $venda->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    @endif

                </div>

            </div>

        </div>
    @endsection
