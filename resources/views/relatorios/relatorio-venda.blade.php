<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Venda</title>
</head>
<body>
<h1>Relatório de Venda</h1>
<p>Data Inicial: {{ date('d-m-Y', strtotime($data_inicial)) }}</p>
<p>Data Final: {{ date('d-m-Y', strtotime($data_final)) }}</p>

<table border="1" width="100%">
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

</body>
</html>
