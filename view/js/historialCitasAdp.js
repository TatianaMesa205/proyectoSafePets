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
                    <h5 style="color:#8b5e3c; margin-top:20px;">No tienes citas registradas 🐾</h5>
                </div>`;
                return;
            }

            // --- AQUI CREAMOS LOS TÍTULOS CON LAS LÍNEAS A AMBOS LADOS ---
            let htmlCitasPresentes = `
                <div class="titulo-decorado">Citas del Presente</div>
                <div class="contenedor-citas" id="citasPresentes"></div>
            `;

            let htmlCitasPasadas = `
                <div class="titulo-decorado">Citas Pasadas</div>
                <div class="contenedor-citas" id="citasPasadas"></div>
            `;

            contenedor.innerHTML = htmlCitasPresentes + htmlCitasPasadas;

            const contPresente = document.getElementById("citasPresentes");
            const contPasadas = document.getElementById("citasPasadas");

            // Fecha actual
            let hoy = new Date().toISOString().split("T")[0];

            res.listaCitas.forEach(cita => {

                // Determinar si es pasada o presente
                let fechaCita = cita.fecha_cita;
                let targetContenedor = (fechaCita < hoy) ? contPasadas : contPresente;

                // ESTADOS
                let estadoHTML = "";
                let estado = cita.estado.toLowerCase();

                if (estado === "cancelada") {
                    estadoHTML = `<span class="estado-cancelada"><i class="fa-solid fa-ban"></i> Cancelada</span>`;
                } else if (estado === "finalizada") {
                    estadoHTML = `<span class="estado-finalizada"><i class="fa-solid fa-house-chimney-user"></i> Finalizada</span>`;
                } else if (estado === "completada") {
                    estadoHTML = `<span class="estado-finalizada"><i class="fa-solid fa-check-double"></i> Completada</span>`;
                } else if (estado === "confirmada") {
                    estadoHTML = `<span class="estado-activa"><i class="fa-solid fa-check"></i> Confirmada</span>`;
                } else {
                    estadoHTML = `<span class="estado-pendiente"><i class="fa-solid fa-hourglass-half"></i> Pendiente</span>`;
                }

                // BOTÓN CANCELAR
                let botonCancelar = "";
                if (estado === "pendiente" || estado === "confirmada") {
                    botonCancelar = `
                        <button class="btn-cancelar" onclick="confirmarCancelacion(${cita.id_citas}, '${cita.fecha_cita}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>`;
                }

                let imagenMascota = cita.imagen ? `../../../CarpetaCompartida/Mascotas/${cita.imagen}` : "view/img/default-pet.png";

                // --- TARJETA CON LA CLASE 'cita-card' ---
                targetContenedor.innerHTML += `
                    <div class="cita-card">
                        <img src="${imagenMascota}" alt="Mascota">
                        
                        <div class="estado-container">
                            ${estadoHTML}
                        </div>

                        <div>
                            ${botonCancelar} 
                            <h5>${cita.mascota}</h5>
                        </div>

                        <p><strong>Fecha:</strong> ${cita.fecha_cita}</p>
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
    let fechaCitaMs = new Date(fecha_cita).getTime();
    let ahoraMs = new Date().getTime();
    let horasDiferencia = (fechaCitaMs - ahoraMs) / 1000 / 3600;

    if (horasDiferencia < 48) {
        Swal.fire("No permitido", "No es posible cancelar tan cerca de la hora acordada.", "warning");
        return;
    }

    Swal.fire({
        title: "¿Seguro que deseas cancelar?",
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
                return JSON.parse(texto);
            })
            .then(response => {
                if (response.codigo === "200") {
                    Swal.fire("Cancelada", "La cita fue cancelada.", "success");
                    cargarCitas(document.getElementById("id_adoptante_sesion").value);
                } else {
                    Swal.fire("Error", response.mensaje, "error");
                }
            });
        }
    });
}