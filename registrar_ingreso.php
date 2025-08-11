<?php
$conn = new mysqli("localhost", "root", "", "clinica_san_pedro");
if ($conn->connect_error) die("Error");

$stmt = $conn->prepare("INSERT INTO ingresos (codigo_ingreso, id_paciente, id_medico, numero_habitacion, numero_cama, fecha_ingreso, diagnostico) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siissss", $_POST['codigo_ingreso'], $_POST['id_paciente'], $_POST['id_medico'], $_POST['habitacion'], $_POST['cama'], $_POST['fecha_ingreso'], $_POST['diagnostico']);

if ($stmt->execute()) {
    echo "<div class='alert'>Ingreso registrado correctamente</div>";
} else {
    echo "<div class='alert' style='background:#f8d7da;color:#721c24'>Error: código ya existe o datos inválidos.</div>";
}
echo "<a href='index.php' style='display:block;text-align:center;margin-top:10px;color:#0056b3'>Volver</a>";
$stmt->close();
$conn->close();
?>