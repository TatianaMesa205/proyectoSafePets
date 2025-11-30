document.addEventListener("DOMContentLoaded", function () {

    const idAdoptante = document.getElementById("id_adoptante_sesion")?.value || null;
    const contenedor = document.getElementById("listaCitasAdoptante");

    const itemHistorial = document.querySelector(".menu-item:nth-child(2)");

    if (itemHistorial) {

        itemHistorial.addEventListener("click", function () {

            if (!idAdoptante) {
                contenedor.innerHTML = `
                    <div class='col-12 text-center text-danger'>
                        <h5>No se encontró el adoptante ❌</h5>
                    </div>`;
                return;
            }

            cargarCitas(idAdoptante);
        });
    }
});



function cargarCitas(idAdoptante) {

    const contenedor = document.getElementById("listaCitasAdoptante");

    let datos = new FormData();
    datos.append("listarCitasAdoptante", "ok");
    datos.append("id_adoptantes", idAdoptante);

    fetch("controller/citasController.php", {
        method: "POST",
        body: datos
    })
        .then(response => response.json())
        .then(res => {

            contenedor.innerHTML = "";

            if (res.codigo !== "200" || !res.listaCitas || res.listaCitas.length === 0) {
                contenedor.innerHTML = `
                <div class='col-12 text-center'>
                    <h5 style="color:#8b5e3c;">No tienes citas registradas 🐾</h5>
                </div>`;
                return;
            }

            // Crear secciones
            let htmlCitasPresentes = `
                <h4 style="color:#8b5e3c; font-weight:700;">Citas del Presente</h4>
                <div class="row g-3" id="citasPresentes"></div>
                <hr class="my-4">
            `;

            let htmlCitasPasadas = `
                <h4 style="color:#8b5e3c; font-weight:700;">Citas Pasadas</h4>
                <div class="row g-3" id="citasPasadas"></div>
            `;

            contenedor.innerHTML = htmlCitasPresentes + htmlCitasPasadas;

            const contPresente = document.getElementById("citasPresentes");
            const contPasadas = document.getElementById("citasPasadas");

            // Fecha actual (solo yyyy-mm-dd)
            let hoy = new Date().toISOString().split("T")[0];

            res.listaCitas.forEach(cita => {

                // --- Determinar si es pasada o presente ---
                let fechaCita = cita.fecha_cita;   // formato: YYYY-MM-DD
                let targetContenedor = (fechaCita < hoy) ? contPasadas : contPresente;

                // --- ESTADOS ---
                let estadoHTML = "";
                let estado = cita.estado.toLowerCase();

                if (estado === "cancelada") {
                    estadoHTML = `<span class="estado-cancelada">
                            <i class="fa-solid fa-ban"></i> Cancelada
                        </span>`;
                } else if (estado === "finalizada") {
                    estadoHTML = `<span class="estado-finalizada">
                            <i class="fa-solid fa-house-chimney-user"></i> Finalizada
                        </span>`;
                } else if (estado === "completada") { 
                    // ✅ CORRECCIÓN AGREGADA AQUÍ
                    estadoHTML = `<span class="estado-finalizada">
                            <i class="fa-solid fa-check-double"></i> Completada
                        </span>`;
                } else if (estado === "confirmada") {
                    estadoHTML = `<span class="estado-activa">
                            <i class="fa-solid fa-check"></i> Confirmada
                        </span>`;
                } else {
                    // PENDIENTE (Default)
                    estadoHTML = `<span class="estado-pendiente">
                            <i class="fa-solid fa-hourglass-half"></i> Pendiente
                        </span>`;
                }

                // BOTÓN CANCELAR SOLO SI ES PENDIENTE O CONFIRMADA
                let botonCancelar = "";
                if (estado === "pendiente" || estado === "confirmada") {
                    botonCancelar = `
                        <button class="btn-cancelar" onclick="confirmarCancelacion(${cita.id_citas}, '${cita.fecha_cita}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>`;
                }

                // Asegurar ruta de imagen
                let imagenMascota = cita.imagen ? `../../../CarpetaCompartida/Mascotas/${cita.imagen}` : "view/img/default-pet.png";

                // Tarjeta de cita
                targetContenedor.innerHTML += `
                    <div class="col-md-4">
                        <div class="card-cita">

                            <img src="${imagenMascota}" alt="Mascota">

                            ${estadoHTML}

                            ${botonCancelar} <h5>${cita.mascota}</h5>

                            <p><strong>Fecha cita:</strong> ${cita.fecha_cita}</p>

                        </div>
                    </div>
                `;

            });

        })
        .catch(err => {
            contenedor.innerHTML = `
                <div class='col-12 text-center text-danger'>
                    Error al cargar las citas ⚠️
                </div>`;
            console.error("Error:", err);
        });
}



function confirmarCancelacion(id_cita, fecha_cita) {

    // Validar diferencia de 48 horas
    let fechaCitaMs = new Date(fecha_cita).getTime();
    let ahoraMs = new Date().getTime();

    let horasDiferencia = (fechaCitaMs - ahoraMs) / 1000 / 3600;

    if (horasDiferencia < 48) {
        Swal.fire(
            "No permitido",
            "No es posible cancelar tan cerca de la hora acordada.",
            "warning"
        );
        return;
    }

    // Modal de confirmación
    Swal.fire({
        title: "¿Seguro que deseas cancelar esta cita?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, cancelar",
        cancelButtonText: "No, volver"
    }).then(result => {

        if (result.isConfirmed) {

            let datos = new FormData();
            datos.append("cancelarCita", "ok");
            datos.append("id_citas", id_cita);

            fetch("controller/citasController.php", {
                method: "POST",
                body: datos
            })
                .then(async r => {
                    let texto = await r.text();
                    console.log("RESPUESTA DEL SERVIDOR ↓↓↓");
                    console.log(texto);
                    return JSON.parse(texto);
                })

                .then(response => {

                    if (response.codigo === "200") {
                        Swal.fire("Cancelada", "La cita fue cancelada con éxito.", "success");
                        cargarCitas(document.getElementById("id_adoptante_sesion").value);
                    } else {
                        Swal.fire("Error", response.mensaje, "error");
                    }

                });
        }
    });
}