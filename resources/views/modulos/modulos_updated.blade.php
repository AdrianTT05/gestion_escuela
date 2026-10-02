<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo actualizado</title>
</head>
<body>
    <a href="/modulos">Volver al listado</a>
    <h1>Módulo actualizado correctamente</h1>

    @if (session('moduloActualizado'))
        <div>
            <p><strong>ID:</strong> {{ session('moduloActualizado')['id'] }}</p>
            <p><strong>Código:</strong> {{ session('moduloActualizado')['codigo'] }}</p>
            <p><strong>Nombre:</strong> {{ session('moduloActualizado')['nombre'] }}</p>
            <p><strong>Curso:</strong> {{ session('moduloActualizado')['curso'] }}</p>
            <p><strong>Profesor:</strong> {{ session('moduloActualizado')['profesor'] }}</p>
        </div>
    @else
        <p>No hay datos del módulo actualizado.</p>
    @endif

</body>
</html>
