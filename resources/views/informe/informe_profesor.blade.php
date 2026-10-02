<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulos del profesor - Escuela</title>
</head>
<body>
    <a href="/informe">Volver al informe</a>
    <h1>Módulos del profesor</h1>
    <ul>
        @forelse ($modulos as $modulo)
            <li>{{ $modulo->codigo }} - {{ $modulo->nombre }} ({{ $modulo->curso }})</li>
        @empty
            <li>Este profesor no tiene módulos.</li>
        @endforelse
    </ul>
</body>
</html>
