<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aulas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Listado de Aulas</h1>

        @if(isset($error))
            <div class="alert alert-danger">
                <p>{{ $error }}</p>
            </div>
        @elseif(!empty($aulas))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Zona</th>
                        <!-- Añade más columnas según la estructura de tus datos -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aulas as $aula)
                        <tr>
                            <td>{{ $aula['id'] }}</td>
                            <td>{{ $aula['nombre'] }}</td>
                            <td>{{ $aula['capacidad'] }}</td>
                            <td>{{ $aula['zona'] }}</td>
                            <!-- Añade más datos según la estructura de tus datos -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No se encontraron aulas.</p>
        @endif
    </div>
</body>
</html>
