<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesor actualizado</title>
</head>
<body>
    <a href="/profesores">Volver al listado</a>
    <h1>Profesor actualizado correctamente</h1>

    @if (session('profesorActualizado'))
        <div>
            <p><strong>ID:</strong> {{ session('profesorActualizado')['id'] }}</p>
            <p><strong>Nombre:</strong> {{ session('profesorActualizado')['nombre'] }}</p>
            <p><strong>Email:</strong> {{ session('profesorActualizado')['email'] }}</p>
        </div>
    @else
        <p>No hay datos del profesor actualizado.</p>
    @endif
</body>
</html>
