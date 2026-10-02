<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesor eliminado</title>
</head>
<body>
    <a href="/profesores">Volver al listado</a>
    <h1>Profesor eliminado correctamente</h1>

    @if (session('profesorEliminado'))
        <p><strong>ID:</strong> {{ session('profesorEliminado')['id'] }}</p>
    @else
        <p>No hay datos del profesor eliminado.</p>
    @endif
</body>
</html>
