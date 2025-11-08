class Citas {
    constructor(objData){
        this._objData = objData;
    }
    listarCitas(){
        let objData = new FormData();
        objData.append("listarCitas",this._objData.listarCitas);

        fetch("controller/citasController.php",{
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            console.log(response);

            if (response["codigo"] == "200"){
                let dataSet = [];

                response["listaCitas"].forEach(item => {
                    let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += '<button id="btn-editarCita" type="button" style="background-color:pink; border-color:pink; color:white" class="btn" citas="'+item.id_citas+'" adoptantes="'+item.id_adoptantes+'" mascotas="'+item.id_mascotas+'" fecha_cita="'+item.fecha_cita+'" estado="'+item.estado+'" motivo="'+item.motivo+'"><i class="bi bi-pencil"></i></button>';
                    objBotones += '<button id="btn-eliminarCita" type="button" style="background-color:rgb(158,147,223); color:white" class="btn" citas="'+item.id_citas+'"><i class="bi bi-trash"></i></button>';
                    objBotones += '</div>';

                    dataSet.push([
                        item.id_adoptantes,
                        item.id_mascotas,
                        item.fecha_cita,
                        item.estado,
                        item.motivo,
                        objBotones
                    ]);
                });

                $("#tablaCitas").DataTable({
                    buttons:[{
                        extend: "colvis",
                        text: "Columnas"
                    },
                    "excel",
                    "pdf",
                    "print"
                    ],
                    dom: "Bfrtip",
                    responsive: true,
                    destroy:true,
                    data:dataSet
                });
            }else{
                console.log("error");
            }
        })
    }



    eliminarCita(){
        let objData = new FormData();
        objData.append("eliminarCita",this._objData.eliminarCita);
        objData.append("id_cita",this._objData.id_cita);
        fetch("controller/citasController.php",{
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            console.log(error);
        })
        .then(response =>{
            if (response["codigo"] == "200"){
                this.listarCitas();
                Swal.fire({
                    title: "Cita eliminada correctamente :(",
                    width: 600,
                    padding: "3em",
                    color: "#ba88d1",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("https://i.pinimg.com/originals/ba/c1/cd/bac1cdc1522ec6e9305e9e9b38b20bfd.gif")
                        left top
                        no-repeat
                    `,timer: 6000
                    });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }

    registrarCita(){

        console.log(this._objData.registrarCita);

        let objDataCita = new FormData();
        objDataCita.append("registrarCita",this._objData.registrarCita);
        objDataCita.append("id_adoptantes",this._objData.id_adoptantes);
        objDataCita.append("id_mascotas",this._objData.id_mascotas);
        objDataCita.append("fecha_cita",this._objData.fecha_cita);
        objDataCita.append("estado",this._objData.estado);
        objDataCita.append("motivo",this._objData.motivo);

        fetch('controller/citasController.php',{
            method: 'POST',
            body:objDataCita
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{

            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formRegistroCitas');
                formulario.reset();
                $("#panelFormularioCitas").hide();
                $("#panelTablaCitas").show();
                this.listarCitas();

                    Swal.fire({
                    title: "Cita registrada correctamente :D",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("https://i.pinimg.com/originals/3a/fb/fa/3afbfa4d4048a3dbbd56fac372de781f.gif")
                        left top
                        no-repeat
                    `,timer: 1600
                    });


            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }


    editarCita(){

        let objDataCita = new FormData();
        objDataCita.append("editarCita",this._objData.editarCita);
        objDataCita.append("id_cita",this._objData.id_cita);
        objDataCita.append("id_adoptantes",this._objData.id_adoptantes);
        objDataCita.append("id_mascotas",this._objData.id_mascotas);
        objDataCita.append("fecha_cita",this._objData.fecha_cita);
        objDataCita.append("estado",this._objData.estado);
        objDataCita.append("motivo",this._objData.motivo);
        fetch('controller/citasController.php',{
            method: 'POST',
            body:objDataCita
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{

            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formEditarCitas');
                formulario.reset();
                $("#panelFormularioEditarCitas").hide();
                $("#panelTablaCitas").show();
                this.listarCitas();

                    Swal.fire({
                    title: "Cita editada correctamente :D",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff url(/images/trees.png)",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("https://i.pinimg.com/originals/3a/fb/fa/3afbfa4d4048a3dbbd56fac372de781f.gif")
                        left top
                        no-repeat
                    `
                    });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }



//SELECTS FORMULARIO DE LA MASCOTA //

  cargarSelects() {
      this.cargarMascotas();
  }

  cargarMascotas() {
        let objData = new FormData();
        objData.append("listarMascotas", "ok");

        fetch("controller/mascotasController.php", {
            method: 'POST',
            body: objData
        })
        .then(response => response.json())
        .then(response => {
            if (response["codigo"] == "200") {
                let select = document.getElementById('select_usuario');
                select.innerHTML = '<option value="">Seleccione un mascota</option>';
                
                response["listaMascotas"].forEach(usuario => {
                    select.innerHTML += `<option value="${mascotas.id_mascotas}">${mascotas.nombre} - ${usuario.especie}</option>`;
                });
            }
        })
        .catch(error => console.log(error));
    }
}
