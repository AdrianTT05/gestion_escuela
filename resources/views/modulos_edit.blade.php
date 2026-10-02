<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Módulo</title>
</head>
<body>
    <h1>Editar Módulo #{{ $modulo['id'] }}</h1>
    <form action="/modulos/{{ $modulo['id'] }}" method="POST">
        @csrf
        @method('PUT')
        <label>Código: <input type="text" name="codigo" value="{{ $modulo['codigo'] }}"></label><br>
        <label>Nombre: <input type="text" name="nombre" value="{{ $modulo['nombre'] }}"></label><br>
        <label>Curso: <input type="text" name="curso" value="{{ $modulo['curso'] }}"></label><br>
        <label>Profesor: <input type="text" name="profesor" value="{{ $modulo['profesor'] }}"></label><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>