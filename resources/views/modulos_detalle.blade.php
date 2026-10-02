<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Módulo - {{ $modulo['nombre'] }}</title>
</head>
<body>
    <a href="/modulos">Volver al listado</a>

    <h1>Detalle del Módulo #{{ $modulo['id'] }}</h1>

    <p><strong>ID:</strong> {{ $modulo['id'] }}</p>
    <p><strong>Código:</strong> {{ $modulo['codigo'] }}</p>
    <p><strong>Nombre:</strong> {{ $modulo['nombre'] }}</p>
    <p><strong>Curso:</strong> {{ $modulo['curso'] }}</p>
    <p><strong>Profesor:</strong> {{ $modulo['profesor'] }}</p>

    <a href="/modulos/{{ $modulo['id'] }}/edit">Editar módulo</a>
</body>
</html>