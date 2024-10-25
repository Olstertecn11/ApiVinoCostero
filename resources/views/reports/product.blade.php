<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8d7da;
            color: #333;
        }
        td {
            background-color: #fff;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre del Producto</th>
                @if(isset($products[0]->quantity_sold))
                    <th>Cantidad Vendida</th>
                @elseif(isset($products[0]->average_rating))
                    <th>Calificación Promedio</th>
                @elseif(isset($products[0]->favorites_count))
                    <th>Cantidad de Favoritos</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                @if(isset($product->quantity_sold))
                    <td>{{ $product->quantity_sold }}</td>
                @elseif(isset($product->average_rating))
                    <td>{{ number_format($product->average_rating, 2) }}</td>
                @elseif(isset($product->favorites_count))
                    <td>{{ $product->favorites_count }}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        Reporte generado el {{ date('Y-m-d H:i:s') }} por {{ config('app.name') }}
    </footer>
</body>
</html>
