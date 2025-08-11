<?php
$conn = new mysqli("localhost", "root", "", "clinica_san_pedro");
if ($conn->connect_error) die("Error");

$id_ingreso = $_POST['id_ingreso'];
$fecha_cita = $_POST['fecha_cita'];

// Validar que la cita sea posterior a la fecha de alta
$sql = "SELECT fecha_alta FROM ingresos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_ingreso);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row || !$row['fecha_alta'] || $fecha_cita <= $row['fecha_alta']) {
    die("<div class='alert' style='background:#f8d7da;color:#721c24'>❌ La cita debe ser posterior a la fecha de alta.</div><br><a href='index.php'>Volver</a>");
}

$stmt = $conn->prepare("INSERT INTO citas (id_ingreso, fecha_cita, motivo) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $id_ingreso, $fecha_cita, $_POST['motivo']);

if ($stmt->execute()) {
    echo "<div class='alert'>✅ Cita de seguimiento agendada</div>";
} else {
    echo "<div class='alert' style='background:#f8d7da;color:#721c24'>❌ Error al agendar</div>";
}
echo "<a href='index.php' style='display:block;text-align:center;margin-top:10px;color:#0056b3'>Volver</a>";
$stmt->close();
$conn->close();
?>
