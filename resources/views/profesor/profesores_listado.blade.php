<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Profesores - Escuela</title>
</head>
<body>
    <h1>Gestión de Profesores</h1>
    <p>Bienvenido al módulo de administración del departamento.</p>

    <a href="/profesores/create">Añadir profesor</a>

    <h2>Listado de Docentes</h2>

    <ul>
        @foreach ($profesores as $profesor)
            <li><strong>------------------------</strong>
            <li><strong>{{ $profesor->id }}</strong>
            <li><strong>{{ $profesor->nombre }}</strong>
            <li><strong>{{ $profesor->email }}</strong>
            <li><a href="/profesores/{{ $profesor->id }}/edit">Editar</a>
            <li><form action="/profesores/{{ $profesor->id }}" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar este profesor?')">
                @csrf
                @method('DELETE')
                <button type="submit">Borrar</button>
            </form>

        @endforeach

    </ul>
</body>
</html>