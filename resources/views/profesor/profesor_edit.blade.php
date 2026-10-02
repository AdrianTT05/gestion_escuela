<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Profesor</title>
</head>
<body>
    <h1>Editar Profesor #{{ $profesor->id }}</h1>

    <form action="/profesores/{{ $profesor->id }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nombre: <input type="text" name="nombre" value="{{ $profesor->nombre }}"></label><br>
        <label>Email: <input type="email" name="email" value="{{ $profesor->email }}"></label><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
