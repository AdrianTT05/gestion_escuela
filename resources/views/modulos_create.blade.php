<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Módulo</title>
</head>
<body>
    <h1>Añadir Módulo</h1>
    <form action="/modulos" method="POST">
        @csrf
        <label>Código: <input type="text" name="codigo"></label><br>
        <label>Nombre: <input type="text" name="nombre"></label><br>
        <label>Curso: <input type="text" name="curso"></label><br>
        <label>Profesor: <input type="text" name="profesor"></label><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>