<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empleado = [
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'edad' => (int)$_POST['edad'],
        'estado_civil' => $_POST['estado_civil'],
        'sexo' => $_POST['sexo'],
        'sueldo' => $_POST['sueldo'],
    ];

    // Almacenar el empleado en un array de empleados
    $_SESSION['empleados'][] = $empleado;

    echo "Empleado registrado exitosamente.";
}

function filterFemale($empleado) {
    return $empleado['sexo'] === 'Femenino';
}

function filterMarriedHighSalaryMale($empleado) {
    return $empleado['sexo'] === 'Masculino' && $empleado['estado_civil'] === 'Casado(a)' && $empleado['sueldo'] === 'Más de 2500 Bs.';
}

function filterWidowHighSalaryFemale($empleado) {
    return $empleado['sexo'] === 'Femenino' && $empleado['estado_civil'] === 'Viudo(a)' && $empleado['sueldo'] === 'Más de 1000 Bs.';
}

function calculateAverageAge($empleados) {
    $totalAge = array_reduce($empleados, function($carry, $empleado) {
        return $carry + $empleado['edad'];
    }, 0);
    
    return $totalAge / count($empleados);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Empleados</title>
    <link rel="stylesheet" type="text/css" href="asetts\css\styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1>Registro de Empleados</h1>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required><br>

        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" required><br>

        <label for="edad">Edad</label>
        <input type="number" name="edad" required min="18"><br>

        <label for="estado_civil">Estado Civil</label>
            <select name="estado_civil">
                <option value="Soltero(a)">Soltero(a)</option>
                <option value="Casado(a)">Casado(a)</option>
                <option value="Viudo(a)">Viudo(a)</option>
            </select><br>
        <label for="sexo">Sexo:</label>
        <input type="radio" name="sexo" value="Femenino" required>Femenino
        <input type="radio" name="sexo" value="Masculino" required>Masculino<br>

        <label for="sueldo">Sueldo:</label>
        <select name="sueldo">
            <option value="Menos de 1000 Bs">Menos de 1000 Bs</option>
            <option value="Entre 1000 y 2500 Bs">Entre 1000 y 2500 Bs</option>
            <option value="Más de 2500 Bs">Más de 2500 Bs</option>
        </select><br>
  
        <input type="submit" value="Registrar">
    </form>
    <a href="Calcular.php">Consultar Empleados</a>
</body>
</html>