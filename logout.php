<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesión</title>
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
        }
        .logout-container {
            background-color: #ffffff;
            border: 2px solid #4a624f; /* Verde musgo */
            border-radius: 8px;
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logout-container h2 {
            color: #4a624f;
            margin-bottom: 20px;
        }
        .logout-container p {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #4a624f;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #3e5444;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>¡Hasta pronto!</h2>
        <p>Has cerrado sesión correctamente.</p>
        <a href="login.php" class="btn">Volver a Iniciar Sesión</a>
    </div>
</body>
</html>
