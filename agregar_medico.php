<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "usuario", "contraseña", "clinica_db");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre_medico'];
$apellido = $_POST['apellido_medico'];
$especialidad = $_POST['especialidad'];
$telefono = $_POST['telefono_medico'];

// Insertar médico en la base de datos
$sql = "INSERT INTO medicos (nombre, apellido, especialidad, telefono) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombre, $apellido, $especialidad, $telefono);

if ($stmt->execute()) {
    echo "<script>alert('Médico agregado exitosamente'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Error al agregar médico'); window.location.href='index.php';</script>";
}

$stmt->close();
$conn->close();
?>
