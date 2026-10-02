<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe - Escuela</title>
</head>
<body>
    <h1>Informe de la escuela</h1>
    <ul>
        <li>Profesores: {{ $resumen['profesores'] }}</li>
        <li>Módulos: {{ $resumen['modulos'] }}</li>
        <li>Módulos de 1DAW: {{ $resumen['1DAW'] }}</li>
        <li>Módulos de 2DAW: {{ $resumen['2DAW'] }}</li>
    </ul>
</body>
</html>
