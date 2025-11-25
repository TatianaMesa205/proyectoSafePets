document.addEventListener("DOMContentLoaded", function () {

    // 1️⃣ OBTENER ID DEL ADOPTANTE
    const idAdoptante = document.getElementById("id_adoptante_sesion")?.value || null;
    const contenedor = document.getElementById("listaCitasAdoptante");

    // 2️⃣ SELECCIONAR EL ITEM CORRECTO DEL MENÚ
    const itemHistorial = document.querySelector(".menu-item:nth-child(2)");

    if (itemHistorial) {

        itemHistorial.addEventListener("click", function () {

            if (!idAdoptante || idAdoptante.trim() === "") {
                contenedor.innerHTML = `
                    <div class='col-12 text-center text-danger'>
                        <h5>No se encontró el ID del adoptante ❌</h5>
                    </div>`;
                return;
            }

            // Cargar las citas al abrir el historial
            cargarCitas(idAdoptante);
        });
    }
});


// =============================
// 3️⃣ FUNCIÓN PARA CARGAR CITAS
// =============================
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
                </div>
            `;
            return;
        }

        res.listaCitas.forEach(cita => {

            // AQUIIIIIIIII ----> pega el código del estado
            let estadoHTML = "";
            if (cita.estado.toLowerCase() === "cancelada") {
                estadoHTML = `
                    <span class="estado-cancelada">
                        <i class="fa-solid fa-ban"></i> Cancelada
                    </span>
                `;
            } 
            else if (cita.estado.toLowerCase() === "completada") {
                estadoHTML = `
                    <span class="estado-completada">
                        <i class="fa-solid fa-circle-check"></i> Completada
                    </span>
                `;
            } 
            else if (cita.estado.toLowerCase() === "confirmada") {
                estadoHTML = `
                    <span class="estado-activa">
                        <i class="fa-solid fa-check"></i> Confirmada
                    </span>
                `;
            }
            else {
                estadoHTML = `
                    <span class="estado-pendiente">
                        <i class="fa-solid fa-hourglass-half"></i> Pendiente
                    </span>
                `;
            }

            // TARJETA
            contenedor.innerHTML += `
                <div class="cita-card">
                    <img src="../../../CarpetaCompartida/Mascotas/${cita.imagen}" class="cita-img">
                    <h5>${cita.mascota}</h5>
                    <p><strong>Fecha:</strong> ${cita.fecha_cita}</p>
                    ${estadoHTML}
                </div>
            `;
        });


    })
    .catch(err => {
        contenedor.innerHTML = `
            <div class='col-12 text-center text-danger'>
                Error al cargar las citas ⚠️
            </div>
        `;
        console.error("Error:", err);
    });
}


// ====================================
// 4️⃣ POPUP CON DETALLES DE LA CITA
// ====================================
function verDetalles(id) {

    let datos = new FormData();
    datos.append("detalleCita", "ok");
    datos.append("id_citas", id);

    fetch("controller/citasController.php", {
        method: "POST",
        body: datos
    })
    .then(r => r.json())
    .then(cita => {

        Swal.fire({
            title: "Detalles de la Cita",
            html: `
                <strong>Mascota:</strong> ${cita.mascota}<br>
                <strong>Fecha:</strong> ${cita.fecha_cita}<br>
                <strong>Motivo:</strong> ${cita.motivo}<br>
                <strong>Estado:</strong> ${cita.estado}<br><br>

                <img src="../../../CarpetaCompartida/Mascotas/${cita.imagen}" 
                     style="width:140px;border-radius:12px;">
            `,
            confirmButtonText: "Cerrar",
            confirmButtonColor: "#8b5e3c"
        });

    })
    .catch(err => {
        console.error("Error:", err);
    });
}
