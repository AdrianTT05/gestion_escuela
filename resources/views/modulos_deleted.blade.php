<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo Eliminado</title>
</head>
<body>
    <a href="/modulos">Volver al listado</a>
    <h1>Módulo eliminado correctamente</h1>

    @if (session('moduloEliminado'))
        <p><strong>ID:</strong> {{ session('moduloEliminado')['id'] }}</p>
    @else
        <p>No hay datos del módulo eliminado.</p>
    @endif
</body>
</html>