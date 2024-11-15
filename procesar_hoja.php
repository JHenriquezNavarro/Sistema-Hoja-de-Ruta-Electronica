<?php
require 'db.php';
session_start();

$usuario_id = $_SESSION['usuario_id'];
$tipo_servicio = $_POST['tipo_servicio'];
$nro_cuadrante = $_POST['nro_cuadrante'];
$fecha = $_POST['fecha'];
$nro_lista_servicio = $_POST['nro_lista_servicio'];
$medio_vigilancia = $_POST['medio_vigilancia'];
$sigla_vehiculo = $_POST['sigla_vehiculo'];
$km_salida = $_POST['km_salida'];
$km_regreso = $_POST['km_regreso'];
$km_recorrido = $_POST['km_recorrido'];
$origen_evento = $_POST['origen_evento'];
$motivo = $_POST['motivo'];
$en_cuadrante = $_POST['en_cuadrante'];
$direccion = $_POST['direccion'];
$numero = $_POST['numero'];
$comuna = $_POST['comuna'];
$region = $_POST['region'];
$hora_inicio = $_POST['hora_inicio'];
$grado_fiscalizador = $_POST['grado_fiscalizador'];
$nombres_fiscalizador = $_POST['nombres_fiscalizador'];
$apellido_paterno_fiscalizador = $_POST['apellido_paterno_fiscalizador'];
$apellido_materno_fiscalizador = $_POST['apellido_materno_fiscalizador'];
$cargo_fiscalizador = $_POST['cargo_fiscalizador'];
$nro_evento = $_POST['nro_evento'];
$novedades_fiscalizacion = $_POST['novedades_fiscalizacion'];

$stmt = $pdo->prepare("INSERT INTO hoja_ruta (usuario_id, tipo_servicio, nro_cuadrante, fecha, nro_lista_servicio, medio_vigilancia, sigla_vehiculo, km_salida, km_regreso, km_recorrido, origen_evento, motivo, en_cuadrante, direccion, numero, comuna, region, hora_inicio, grado_fiscalizador, nombres_fiscalizador, apellido_paterno_fiscalizador, apellido_materno_fiscalizador, cargo_fiscalizador, nro_evento, novedades_fiscalizacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt->execute([$usuario_id, $tipo_servicio, $nro_cuadrante, $fecha, $nro_lista_servicio, $medio_vigilancia, $sigla_vehiculo, $km_salida, $km_regreso, $km_recorrido, $origen_evento, $motivo, $en_cuadrante, $direccion, $numero, $comuna, $region, $hora_inicio, $grado_fiscalizador, $nombres_fiscalizador, $apellido_paterno_fiscalizador, $apellido_materno_fiscalizador, $cargo_fiscalizador, $nro_evento, $novedades_fiscalizacion])) {
    echo "Hoja de ruta guardada exitosamente.";
} else {
    echo "Error al guardar la hoja de ruta.";
}
?>
