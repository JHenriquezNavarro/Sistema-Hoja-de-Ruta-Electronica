<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php';

// Consulta el privilegio actual del usuario desde la base de datos
$usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare("SELECT privilegio FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch();

if ($usuario) {
    // Actualiza el privilegio en la sesión con el valor más reciente de la base de datos
    $_SESSION['privilegio'] = $usuario['privilegio'];
}

include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding-top: 70px; /* Espacio para la barra de navegación fija */
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            border: 2px solid #4a624f; /* Verde musgo */
            border-radius: 8px;
            padding: 30px 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .container h2 {
            color: #4a624f;
            margin-bottom: 20px;
        }
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
            margin-top: 20px;
        }
        .button-group a {
            text-decoration: none;
            color: #ffffff;
            background-color: #4a624f;
            padding: 10px 20px;
            border-radius: 6px;
            width: 80%;
            max-width: 300px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .button-group a:hover {
            background-color: #3e5444;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenido al Sistema de Hoja de Ruta Electronica</h2>
        <p>Seleccione una opcion para comenzar</p>
        <div class="button-group">
            <!-- Mostrar botón según privilegio -->
            <?php if ($_SESSION['privilegio'] == 'digitador'): ?>
                <a href="views/ingresar_hoja.php">Ingresar Hoja de Ruta</a>
            <?php endif; ?>

            <?php if ($_SESSION['privilegio'] == 'fiscalizador'): ?>
                <a href="views/historial_hojas.php">Historial de Hojas de Ruta</a>
            <?php endif; ?>

            <?php if ($_SESSION['privilegio'] == 'validador'): ?>
                <a href="views/ingresar_hoja.php">Ingresar Hoja de Ruta</a>
                <a href="views/historial_hojas.php">Historial de Hojas de Ruta</a>
                <a href="admin_usuarios.php">Administrar Usuarios</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
