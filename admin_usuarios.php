<?php
require 'db.php';
session_start();

// Verifica si el usuario tiene privilegios de validador para acceder a esta página
if (!isset($_SESSION['usuario_id']) || $_SESSION['privilegio'] !== 'validador') {
    header("Location: login.php");
    exit();
}

include 'navbar.php';

// Mensajes de éxito o error
$mensaje = "";
$tipo_mensaje = "";

// Actualizar privilegios de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $nuevo_privilegio = $_POST['privilegio'];

    // Intentar actualizar el privilegio en la base de datos
    $stmt = $pdo->prepare("UPDATE usuarios SET privilegio = ? WHERE id = ?");
    if ($stmt->execute([$nuevo_privilegio, $usuario_id])) {
        $mensaje = "El privilegio se ha actualizado correctamente.";
        $tipo_mensaje = "exito";
    } else {
        $mensaje = "Hubo un error al actualizar el privilegio. Inténtelo de nuevo.";
        $tipo_mensaje = "error";
    }
}

// Obtener lista de usuarios
$stmt = $pdo->prepare("SELECT id, codigo_funcionario, nombre, apellido_paterno, apellido_materno, privilegio FROM usuarios");
$stmt->execute();
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 70px;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .container {
            width: 90%;
            max-width: 800px;
            background-color: #ffffff;
            padding: 20px;
            border: 2px solid #4a624f;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4a624f;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4a624f;
            color: white;
        }
        select, button {
            padding: 8px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #4a624f;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #3e5444;
        }
        /* Estilos para el mensaje */
        .mensaje {
            display: <?php echo $mensaje ? 'block' : 'none'; ?>;
            background-color: <?php echo $tipo_mensaje === 'exito' ? '#d4edda' : '#f8d7da'; ?>;
            color: <?php echo $tipo_mensaje === 'exito' ? '#155724' : '#721c24'; ?>;
            padding: 15px;
            border: 1px solid <?php echo $tipo_mensaje === 'exito' ? '#c3e6cb' : '#f5c6cb'; ?>;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Administración de Usuarios</h2>

        <!-- Mensaje de éxito o error -->
        <div class="mensaje"><?php echo htmlspecialchars($mensaje); ?></div>

        <table>
            <tr>
                <th>Código Funcionario</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Privilegio</th>
                <th>Acción</th>
            </tr>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['codigo_funcionario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['apellido_paterno']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['apellido_materno']); ?></td>
                    <td>
                        <form method="POST" action="admin_usuarios.php">
                            <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                            <select name="privilegio">
                                <option value="digitador" <?php if ($usuario['privilegio'] == 'digitador')
                                    echo 'selected'; ?>>Digitador</option>
                                <option value="validador" <?php if ($usuario['privilegio'] == 'validador')
                                    echo 'selected'; ?>>Validador</option>
                                <option value="fiscalizador" <?php if ($usuario['privilegio'] == 'fiscalizador')
                                    echo 'selected'; ?>>Fiscalizador</option>
                            </select>
                    </td>
                    <td>
                            <button type="submit">Actualizar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Script para redirigir a home.php después de mostrar el mensaje -->
    <?php if ($mensaje): ?>
        <script>
            alert("<?php echo htmlspecialchars($mensaje); ?>");
            window.location.href = 'home.php';
        </script>
    <?php endif; ?>
</body>
</html>
