<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulos - Escuela</title>
</head>
<body>
    <h1>Gestión de Módulos</h1>
    <a href="/modulos/create">Añadir módulo</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Curso</th>
                <th>Profesor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($modulos as $modulo)
            <tr>
                <td>{{ $modulo->id }}</td>
                <td>{{ $modulo->codigo }}</td>
                <td>{{ $modulo->nombre }}</td>
                <td>{{ $modulo->curso }}</td>
                <td>{{ $modulo->profesor }}</td>
                <td>
                    <a href="/modulos/{{ $modulo->id }}/edit">Editar</a>
                    <form action="/modulos/{{ $modulo->id }}" method="POST" onclick="return confirm('¿Estás seguro de que deseas borrar este módulo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
