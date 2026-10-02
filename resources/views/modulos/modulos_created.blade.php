<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo creado</title>
</head>
<body>
    <a href="/modulos">Volver al listado</a>
    <h1>Módulo creado correctamente</h1>

    @if (session('nuevoModulo'))
        <p><strong>ID:</strong> {{ session('nuevoModulo')['id'] }}</p>
        <p><strong>Código:</strong> {{ session('nuevoModulo')['codigo'] }}</p>
        <p><strong>Nombre:</strong> {{ session('nuevoModulo')['nombre'] }}</p>
        <p><strong>Curso:</strong> {{ session('nuevoModulo')['curso'] }}</p>
        <p><strong>Profesor:</strong> {{ session('nuevoModulo')['profesor'] }}</p>
    @else
        <p>No hay datos del módulo creado.</p>
    @endif
</body>
</html>
