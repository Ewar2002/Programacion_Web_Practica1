<?php
session_start();

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

if (isset($_SESSION['empleados'])) {
    $empleados = $_SESSION['empleados'];

    $totalFemales = count(array_filter($empleados, 'filterFemale'));
    $totalMarriedHighSalaryMales = count(array_filter($empleados, 'filterMarriedHighSalaryMale'));
    $totalWidowHighSalaryFemales = count(array_filter($empleados, 'filterWidowHighSalaryFemale'));
    $averageAgeOfMales = calculateAverageAge(array_filter($empleados, function($empleado) {
        return $empleado['sexo'] === 'Masculino';
    }));

    echo "<h1>Consulta de Empleados</h1>";
    echo "<h3>Total de empleados femenino: $totalFemales</h3>";
    echo "<h3>Total de hombres casados que ganan más de 2500 Bs: $totalMarriedHighSalaryMales</h3>";
    echo "<h3>Total de mujeres viudas que ganan más de 1000 Bs: $totalWidowHighSalaryFemales</h3>";
    echo "<h3>Edad promedio de los hombres: $averageAgeOfMales años</h3>";
} else {
    echo "No hay empleados registrados.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculos</title>
    <link rel="stylesheet" type="text/css" href="asetts\css\styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <a href="index.php">Regresar</a>
</body>
</html>