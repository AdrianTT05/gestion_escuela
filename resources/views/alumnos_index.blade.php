<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Alumnos</title>
</head>
<body>
    <h1>Listado de Alumnos (2º DAW)</h1>

    <ul>
        @foreach ($alumnos as $alumno)
            <li>{{ $alumno['nombre'] }} — Módulo: {{ $alumno['modulo'] }}</li>
        @endforeach
    </ul>
</body>
</html>