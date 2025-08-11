function cargarFechaAlta() {
    const select = document.getElementById('id_ingreso');
    const display = document.getElementById('fecha_alta_display');
    const inputCita = document.getElementById('fecha_cita');
    const id = select.value;

    if (!id) {
        display.textContent = '-';
        inputCita.min = '';
        return;
    }

    fetch(`obtener_ingreso.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data.fecha_alta) {
                const fecha = new Date(data.fecha_alta).toLocaleString();
                display.textContent = fecha;
                inputCita.min = data.fecha_alta;
            } else {
                display.textContent = 'Paciente aún no dado de alta';
                inputCita.min = new Date().toISOString().slice(0, 16);
            }
        });
}