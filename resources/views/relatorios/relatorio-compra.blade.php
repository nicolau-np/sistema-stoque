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
            <th>#</th>
            <th>Data do movimento</th>
            <th>Fornecedor</th>
            <th>Total de Produtos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($compras as $compra)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date('d-m-Y', strtotime($compra->data_movimento)) }}</td>
                <td>{{ $compra->contacto->descricao }}</td>
                <td>{{ $compra->itemStoque->count() }}</td>
            </tr>
        @endforeach

    </tbody>
</table>

</body>
</html>
