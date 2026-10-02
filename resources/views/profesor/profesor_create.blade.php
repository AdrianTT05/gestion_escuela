<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Profesor</title>
</head>
<body>
    <h1>Añadir Profesor</h1>
    <form action="/profesores" method="POST">
        @csrf
        <label>Nombre: <input type="text" name="nombre"></label><br>
        <label>Email: <input type="email" name="email"></label><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
