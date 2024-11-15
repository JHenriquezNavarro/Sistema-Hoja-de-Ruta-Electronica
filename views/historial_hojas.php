<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['privilegio'] !== 'fiscalizador' && $_SESSION['privilegio'] !== 'validador')) {
    header("Location: home.php");
    exit();
}

include '../navbar.php';
require '../db.php';

// Consulta para obtener las hojas de ruta del usuario junto con el grado y nombre del digitador
$stmt = $pdo->prepare("
    SELECT hr.*, u.grado, u.nombre, u.apellido_paterno, u.apellido_materno 
    FROM hoja_ruta hr 
    JOIN usuarios u ON hr.usuario_id = u.id 
    WHERE hr.usuario_id = ?
");
$stmt->execute([$_SESSION['usuario_id']]);
$hojas = $stmt->fetchAll();

// Función para eliminar una hoja de ruta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM hoja_ruta WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$delete_id, $_SESSION['usuario_id']]);
    header("Location: historial_hojas.php"); // Redirige a la misma página para refrescar la tabla
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Hojas de Ruta</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 70px;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            border: 2px solid #4a624f;
            border-radius: 8px;
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
        }
        .container h2 {
            color: #4a624f;
            text-align: center;
            margin-bottom: 20px;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4a624f;
            color: #ffffff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f0f9f4;
        }
        tr:hover {
            background-color: #e8f0ea;
        }
        .btn-link, .btn-delete {
            color: #4a624f;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 16px;
            border: 1px solid #4a624f;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
        .btn-link:hover, .btn-delete:hover {
            background-color: #4a624f;
            color: #ffffff;
        }
        .btn-delete {
            background-color: #e74c3c;
            color: #ffffff;
        }
        .btn-delete:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Historial de Hojas de Ruta</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Grado</th>
                        <th>Nombre del Digitador</th>
                        <th>Tipo de Servicio</th>
                        <th>Fecha del Servicio</th>
                        <th>Medio de Vigilancia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hojas as $hoja): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($hoja['grado']); ?></td>
                            <td><?php echo htmlspecialchars($hoja['nombre'] . ' ' . $hoja['apellido_paterno'] . ' ' . $hoja['apellido_materno']); ?></td>
                            <td><?php echo htmlspecialchars($hoja['tipo_servicio']); ?></td>
                            <td><?php echo htmlspecialchars($hoja['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($hoja['medio_vigilancia']); ?></td>
                            <td>
                                <a href="detalle_hoja.php?id=<?php echo $hoja['id']; ?>" class="btn-link">Ver Detalle</a>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta hoja de ruta?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $hoja['id']; ?>">
                                    <button type="submit" class="btn-delete">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
