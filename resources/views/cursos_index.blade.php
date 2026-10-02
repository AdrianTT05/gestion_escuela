<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Oferta Formativa - Cursos</title>
</head>
<body>
    <h1>Oferta Formativa DAW / DAM</h1>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre del Ciclo</th>
                <th>Turno</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
            <tr>
                <td>{{ $curso['codigo'] }}</td>
                <td>{{ $curso['nombre'] }}</td>
                <td>{{ $curso['turno'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>