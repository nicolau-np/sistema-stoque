<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Compra</title>
</head>
<body>
<h1>Relatório de Compra</h1>
<p>Data Inicial: {{ date('d-m-Y', strtotime($data_inicial)) }}</p>
<p>Data Final: {{ date('d-m-Y', strtotime($data_final)) }}</p>
<table border="1" width="100%">
<thead>
    <tr>
        <th>Descrição</th>
        <th>Preço Unitário</th>
        <th>Quantidade Existente</th>
    </tr>
</thead>
<tbody>
    @foreach ($produtos as $produto)
    @php

    @endphp
    <tr>
        <td>{{ $produto->descricao }}</td>
        <td>{{ number_format($produto->preco_unitario, 2,',','.') }} Kz</td>

        <td></td>
    </tr>
    @endforeach

</tbody>
</table>
</body>
</html>
