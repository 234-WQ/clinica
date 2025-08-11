<?php
$conn = new mysqli("localhost", "root", "", "clinica_san_pedro");
if ($conn->connect_error) die("Error");

$stmt = $conn->prepare("INSERT INTO pacientes (nombre, apellido, direccion, telefono, codigo_postal, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['codigo_postal'], $_POST['fecha_nacimiento']);

if ($stmt->execute()) {
    echo "<div class='alert'>Paciente agregado correctamente</div>";
} else {
    echo "<div class='alert' style='background:#f8d7da;color:#721c24'>Error: " . $stmt->error . "</div>";
}
echo "<a href='index.php' style='display:block;text-align:center;margin-top:10px;color:#0056b3'>Volver</a>";
$stmt->close();
$conn->close();
?>
