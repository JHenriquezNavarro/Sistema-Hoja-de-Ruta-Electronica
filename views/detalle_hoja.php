<?php
require '../db.php';
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

include '../navbar.php';

// Verifica si se recibió un ID de hoja de ruta válido
if (!isset($_GET['id'])) {
    echo "ID de hoja de ruta no especificado.";
    exit();
}

$hoja_id = $_GET['id'];

// Consulta para obtener todos los detalles de la hoja de ruta
$stmt = $pdo->prepare("SELECT * FROM hoja_ruta WHERE id = ? AND usuario_id = ?");
$stmt->execute([$hoja_id, $_SESSION['usuario_id']]);
$hoja = $stmt->fetch();

if (!$hoja) {
    echo "Hoja de ruta no encontrada o no tiene permisos para ver esta hoja de ruta.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Hoja de Ruta</title>
    <style>
        /* Estilos generales */
        * {
            box-sizing: border-box;
        }
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

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4a624f;
            color: #ffffff;
            font-weight: bold;
            width: 33%; /* Tres columnas iguales */
        }
        td {
            background-color: #f0f9f4;
        }
        tr:hover td {
            background-color: #e8f0ea;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detalle de Hoja de Ruta</h2>
        <table>
            <tr>
                <th>Tipo de Servicio</th>
                <th>Fecha</th>
                <th>Medio de Vigilancia</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($hoja['tipo_servicio']); ?></td>
                <td><?php echo htmlspecialchars($hoja['fecha']); ?></td>
                <td><?php echo htmlspecialchars($hoja['medio_vigilancia']); ?></td>
            </tr>
            <tr>
                <th>Nro. Cuadrante</th>
                <th>Nro. Lista del Servicio</th>
                <th>Sigla Vehículo</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($hoja['nro_cuadrante']); ?></td>
                <td><?php echo htmlspecialchars($hoja['nro_lista_servicio']); ?></td>
                <td><?php echo htmlspecialchars($hoja['sigla_vehiculo']); ?></td>
            </tr>
            <tr>
                <th>Km. Salida</th>
                <th>Km. Regreso</th>
                <th>Km. Recorrido</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($hoja['km_salida']); ?></td>
                <td><?php echo htmlspecialchars($hoja['km_regreso']); ?></td>
                <td><?php echo htmlspecialchars($hoja['km_recorrido']); ?></td>
            </tr>
            <tr>
                <th>Origen Evento</th>
                <th>Motivo</th>
                <th>En el Cuadrante</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($hoja['origen_evento']); ?></td>
                <td><?php echo htmlspecialchars($hoja['motivo']); ?></td>
                <td><?php echo htmlspecialchars($hoja['en_cuadrante'] ? 'Sí' : 'No'); ?></td>
            </tr>
            <tr>
                <th>Dirección</th>
                <th>Número</th>
                <th>Comuna</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($hoja['direccion']); ?></td>
                <td><?php echo htmlspecialchars($hoja['numero']); ?></td>
                <td><?php echo htmlspecialchars($hoja['comuna']); ?></td>
            </tr>
            <tr>
                <th>Región</th>
                <th>Hora de Inicio</th>
                <th>Hora de Término</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($hoja['region']); ?></td>
                <td><?php echo htmlspecialchars($hoja['hora_inicio_evento']); ?></td>
                <td><?php echo htmlspecialchars($hoja['hora_termino_evento']); ?></td>
            </tr>
            <tr>
                <th>Descripción Evento</th>
                <th>Constatación de Lesiones</th>
                <th>Alcoholemia</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($hoja['descripcion_evento']); ?></td>
                <td><?php echo htmlspecialchars($hoja['constatacion_lesiones'] ? 'Sí' : 'No'); ?></td>
                <td><?php echo htmlspecialchars($hoja['alcoholemia'] ? 'Sí' : 'No'); ?></td>
            </tr>
            <tr>
                <th>Tipo de Procedimiento</th>
                <th>Cantidad de Infracciones</th>
                <th>Total Detenidos</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($hoja['tipo_procedimiento']); ?></td>
                <td><?php echo htmlspecialchars($hoja['cantidad_infracciones']); ?></td>
                <td><?php echo htmlspecialchars($hoja['total_detenidos']); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
