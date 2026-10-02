<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Profesores - Escuela</title>
</head>
<body>
    <h1>Gestión de Profesores</h1>
    <p>Bienvenido al módulo de administración del departamento.</p>

    <h2>Listado de Docentes</h2>
    <ul>
        @foreach ($profesores as $profesor)
            <li><strong>------------------------</strong> 
            <li><strong>{{ $profesor['id'] }}</strong> 
            <li><strong>{{ $profesor['nombre'] }}</strong> 
            <li><strong>{{ $profesor['email'] }}</strong> 
            <li><strong>
                @foreach ($profesor['modulos'] as $modulo)
                {{ $modulo }}
            @endforeach</strong> 
        @endforeach
    </ul>
</body>
</html>