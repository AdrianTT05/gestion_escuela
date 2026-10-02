<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesor creado</title>
</head>
<body>
    <a href="/profesores">Volver al listado</a>
    <h1>Profesor creado correctamente</h1>

    @if (session('nuevoProfesor'))
        <div>
            <p><strong>ID:</strong> {{ session('nuevoProfesor')['id'] }}</p>
            <p><strong>Nombre:</strong> {{ session('nuevoProfesor')['nombre'] }}</p>
            <p><strong>Email:</strong> {{ session('nuevoProfesor')['email'] }}</p>
        </div>
    @else
        <p>No hay datos del profesor creado.</p>
    @endif
</body>
</html>
