<?php
session_start();
if (!isset($_SESSION['usuario_id']) || ($_SESSION['privilegio'] !== 'digitador' && $_SESSION['privilegio'] !== 'validador')) {
    header("Location: home.php");
    exit();
}

include '../navbar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Hoja de Ruta</title>
    <style>
        /* Reset general de estilos */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #ffffff;
            border: 2px solid #4a624f;
            border-radius: 8px;
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1200px;
            margin-bottom: 20px;
        }
        .container h2 {
            color: #4a624f;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-section {
            margin-bottom: 30px;
        }
        .form-section h3, .form-section h4 {
            color: #4a624f;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 15px;
        }
        .form-group {
            flex: 1;
            background-color: #f0f9f4;
            padding: 10px;
            border: 1px solid #000000;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: bold;
            color: #4a624f;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #4a624f;
            outline: none;
        }
        .btn {
            background-color: #4a624f;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 20px auto 0;
        }
        .btn:hover {
            background-color: #3e5444;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ingresar Hoja de Ruta</h2>
        <form action="procesar_hoja.php" method="POST">

            <!-- Módulo 1: Tipo de Servicio -->
            <div class="form-section">
                <h3>Módulo 1: Tipo de Servicio</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="tipo_servicio">Tipo de Servicio:</label>
                        <select id="tipo_servicio" name="tipo_servicio" required>
                            <option value="1° Turno">1° Turno</option>
                            <option value="2° Turno">2° Turno</option>
                            <option value="3° Turno">3° Turno</option>
                            <option value="1° Patrullaje">1° Patrullaje</option>
                            <option value="2° Patrullaje">2° Patrullaje</option>
                            <option value="Servicio Extraordinario">Servicio Extraordinario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nro_cuadrante">Nro. Cuadrante:</label>
                        <input type="text" id="nro_cuadrante" name="nro_cuadrante" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nro_lista">Nro. Lista del Servicio:</label>
                        <input type="text" id="nro_lista" name="nro_lista" required>
                    </div>
                </div>
            </div>

            <!-- Módulo 2: Medio de Vigilancia -->
            <div class="form-section">
                <h3>Módulo 2: Medio de Vigilancia</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="medio_vigilancia">Medio de Vigilancia:</label>
                        <select id="medio_vigilancia" name="medio_vigilancia" required>
                            <option value="Infantería">Infantería</option>
                            <option value="Motorizado">Motorizado</option>
                            <option value="Bicicleta">Bicicleta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sigla_vehiculo">Sigla Vehículo:</label>
                        <input type="text" id="sigla_vehiculo" name="sigla_vehiculo">
                    </div>
                    <div class="form-group">
                        <label for="km_salida">Km. Salida:</label>
                        <input type="number" id="km_salida" name="km_salida" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="km_regreso">Km. Regreso:</label>
                        <input type="number" id="km_regreso" name="km_regreso" required>
                    </div>
                    <div class="form-group">
                        <label for="km_recorrido">Km. Recorrido:</label>
                        <input type="number" id="km_recorrido" name="km_recorrido" readonly>
                    </div>
                </div>
            </div>

            <!-- Módulo 3: Registro y Novedades del Servicio -->
            <div class="form-section">
                <h3>Módulo 3: Registro y Novedades del Servicio</h3>

                <!-- Submódulo 1: Inicio Actividad -->
                <h4>Submódulo 1: Inicio Actividad</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="origen_evento">Origen del Evento:</label>
                        <input type="text" id="origen_evento" name="origen_evento">
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo:</label>
                        <input type="text" id="motivo" name="motivo">
                    </div>
                    <div class="form-group">
                        <label for="en_cuadrante">En el Cuadrante:</label>
                        <select id="en_cuadrante" name="en_cuadrante">
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion">
                    </div>
                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input type="text" id="numero" name="numero">
                    </div>
                    <div class="form-group">
                        <label for="comuna">Comuna:</label>
                        <input type="text" id="comuna" name="comuna">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="region">Región:</label>
                        <input type="text" id="region" name="region">
                    </div>
                    <div class="form-group">
                        <label for="hora_inicio">Hora de Inicio:</label>
                        <input type="time" id="hora_inicio" name="hora_inicio">
                    </div>
                </div>

                <!-- Submódulo 2: Verificación Identidad -->
                <h4>Submódulo 2: Verificación Identidad</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="motivo_no_corresponde">Motivo (si no corresponde):</label>
                        <input type="text" id="motivo_no_corresponde" name="motivo_no_corresponde">
                    </div>
                    <div class="form-group">
                        <label for="nombres">Nombres:</label>
                        <input type="text" id="nombres" name="nombres">
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno:</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno:</label>
                        <input type="text" id="apellido_materno" name="apellido_materno">
                    </div>
                    <div class="form-group">
                        <label for="rut_pasaporte">RUT/Pasaporte:</label>
                        <input type="text" id="rut_pasaporte" name="rut_pasaporte">
                    </div>
                    <div class="form-group">
                        <label for="calidad">Calidad:</label>
                        <select id="calidad" name="calidad">
                            <option value="victima">Víctima</option>
                            <option value="testigo">Testigo</option>
                            <option value="entrevistado">Entrevistado</option>
                        </select>
                    </div>
                </div>

                <!-- Submódulo 3: Descripción y/u Observación Evento -->
                <h4>Submódulo 3: Descripción y/u Observación Evento</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="constatacion_lesiones">Constatación de Lesiones:</label>
                        <select id="constatacion_lesiones" name="constatacion_lesiones">
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alcoholemia">Alcoholemia:</label>
                        <select id="alcoholemia" name="alcoholemia">
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>

                <!-- Botón de Enviar -->
                <button type="submit" class="btn">Guardar Hoja de Ruta</button>
            </form>
    </div>
</body>
</html>
