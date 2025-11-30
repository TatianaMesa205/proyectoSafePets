class Donaciones {
    
    // 1. EL CONSTRUCTOR (Esto faltaba y es clave)
    constructor(objData){
        this._objData = objData;
    }

    // 2. LA NUEVA FUNCIÓN DE STRIPE (La que ya tenías)
    registrarDonacion(){
        
        // !! RECUERDA PONER TU CLAVE PUBLICABLE (pk_test_...) !!
        const stripe_public_key = "pk_test_51SSSa5KPG83aCazK8rud8iuNSmoKTpmPnv4ROZhgb0hhJkANFa9koFTyZ5vvKZuVFaAdSAKvnXJBjeCg7Bw5ybpK00hk9gE2Oo";
        const stripe = Stripe(stripe_public_key);

        // Preparamos los datos para enviar al controlador
        let objData = new FormData();
        objData.append("registrarDonacion", "ok");
        objData.append("monto", this._objData.monto); // El monto que recibimos del formulario
        
        // Mostramos un mensaje de "Cargando..."
        const swalLoading = Swal.fire({
            title: 'Conectando con Stripe...',
            text: 'Por favor espera.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // 1. Llamamos a NUESTRO controlador
        fetch("controller/donacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .catch(e => {
            swalLoading.close();
            console.log(e);
            Swal.fire("Error", "No se pudo conectar con el servidor.", "error");
        })
        .then(response => {
            swalLoading.close(); // Cerramos el "Cargando..."
            
            if (response["codigo"] == "200" && response.sessionId) {
                // 2. ¡Éxito! El controlador nos dio un ID de sesión.
                // 3. Redirigimos al usuario a la pasarela de pago de Stripe.
                stripe.redirectToCheckout({ sessionId: response.sessionId });
                
            } else {
                // Hubo un error (PHP o Stripe)
                Swal.fire({
                    title: "Error al iniciar el pago",
                    text: response["mensaje"] || "No se pudo iniciar el pago.",
                    icon: "error"
                });
            }
        });
    }


    listarDonaciones(){
        let objData = new FormData();
        objData.append("listarDonaciones", this._objData.listarDonaciones);

        fetch("controller/donacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .catch(e => console.log(e))
        .then(response => {
            if (response["codigo"] == "200") {
                let dataSet = [];
                response["listaDonaciones"].forEach(item => {
                    let botones = `
                        <div class="btn-group">
                            <button id="btn-editarDonacion" class="btn" style="background-color:pink;border-color:pink;color:white"
                                donacion="${item.id_donaciones}"
                                usuario="${item.id_usuarios}"
                                monto="${item.monto}"
                                fecha="${item.fecha_donacion}"
                                metodo_pago="${item.metodo_pago}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button id="btn-eliminarDonacion" class="btn" style="background-color:rgb(158,147,223);color:white"
                                donacion="${item.id_donaciones}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                    dataSet.push([
                        item.usuario,
                        item.codigo_referencia,
                        item.monto,
                        item.estado_pago,
                        item.fecha,
                        botones
                    ]);
                });

                $("#tablaDonaciones").DataTable({
                    destroy: true,
                    responsive: true,
                    dom: "Bfrtip",
                    buttons: ["colvis", "excel", "pdf", "print"],
                    data: dataSet
                });
            }
        });
    }

    eliminarDonacion(){
        let objData = new FormData();
        objData.append("eliminarDonacion", this._objData.eliminarDonacion);
        objData.append("id_donaciones", this._objData.id_donaciones);

        fetch("controller/donacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                this.listarDonaciones();
                Swal.fire({
                    title: "Donación eliminada correctamente 💸",
                    color: "#ba88d1",
                    background: "#fff",
                    timer: 1800
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }

    editarDonacion(){
        let objData = new FormData();
        objData.append("editarDonacion", "ok");
        objData.append("id_donaciones", this._objData.id_donaciones);
        objData.append("id_usuarios", this._objData.id_usuarios);
        objData.append("monto", this._objData.monto);
        objData.append("fecha_donacion", this._objData.fecha_donacion); // Asegúrate que tu BD tenga este campo
        objData.append("metodo_pago", this._objData.metodo_pago);

        fetch("controller/donacionesController.php", {
            method: "POST",
            body: objData
        })
        .then(r => r.json())
        .then(response => {
            if (response["codigo"] == "200") {
                document.getElementById("formEditarDonacion").reset();
                $("#panelFormularioEditarDonaciones").hide();
                $("#panelTablaDonaciones").show();
                this.listarDonaciones();
                Swal.fire({
                    title: "Donación actualizada 💰",
                    timer: 1600
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }


    
}