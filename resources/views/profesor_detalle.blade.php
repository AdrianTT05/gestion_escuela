<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha del Profesor</title>
</head>
<body>
    <a href="/profesores">← Volver al listado</a>
    <h1>Ficha Técnica del Profesor</h1>

    <div>

        <p><strong>ID:</strong> {{ $profesor['id'] }}</p>
        <p><strong>Nombre:</strong> {{ $profesor['nombre'] }}</p>
        <p><strong>Email:</strong> {{ $profesor['email'] }}</p>
        @foreach ($profesor['modulos'] as $modulo)
            <p><strong>Módulo impartido:</strong> {{ $modulo }}</p>
        @endforeach
    </div>
</body>
</html>