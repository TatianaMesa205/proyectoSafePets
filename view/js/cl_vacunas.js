class Vacunas {
    constructor(objData){
        this._objData = objData;
    }

    listarVacunas(){
        let objData = new FormData();
        objData.append("listarVacunas", this._objData.listarVacunas);

        fetch("controller/vacunasController.php", {
            method: "POST",
            body: objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            if (response["codigo"] == "200"){
                let dataSet = [];

                response["listaVacunas"].forEach(item => {
                    let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += `<button id="btn-editarVacuna" type="button" style="background-color:pink; border-color:pink; color:white" class="btn"
                        vacuna="${item.id_vacunas}" nombre="${item.nombre_vacuna}" tiempo="${item.tiempo_aplicacion}">
                        <i class="bi bi-pencil"></i></button>`;
                    objBotones += `<button id="btn-eliminarVacuna" type="button" style="background-color:rgb(158,147,223); color:white" class="btn"
                        vacuna="${item.id_vacunas}"><i class="bi bi-trash"></i></button>`;
                    objBotones += '</div>';

                    dataSet.push([
                        item.id_vacunas,
                        item.nombre_vacuna,
                        item.tiempo_aplicacion,
                        objBotones
                    ]);
                });

                $("#tablaVacunas").DataTable({
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

    eliminarVacuna(){
        let objData = new FormData();
        objData.append("eliminarVacuna", this._objData.eliminarVacuna);
        objData.append("id_vacunas", this._objData.id_vacunas);

        fetch("controller/vacunasController.php", {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            console.log(error);
        })
        .then(response =>{
            if (response["codigo"] == "200"){
                this.listarVacunas();
                Swal.fire({
                    title: "Vacuna eliminada correctamente 💉",
                    width: 600,
                    padding: "3em",
                    color: "#ba88d1",
                    background: "#fff",
                    backdrop: `
                        rgba(0,0,123,0.4)
                        url("https://i.pinimg.com/originals/ba/c1/cd/bac1cdc1522ec6e9305e9e9b38b20bfd.gif")
                        left top
                        no-repeat
                    `,
                    timer: 1800
                });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }

    registrarVacuna(){
        let objData = new FormData();
        objData.append("registrarVacuna", "ok");
        objData.append("nombre_vacuna", this._objData.nombre_vacuna);
        objData.append("tiempo_aplicacion", this._objData.tiempo_aplicacion);

        fetch('controller/vacunasController.php', {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formRegistroVacuna');
                formulario.reset();
                $("#panelFormularioVacunas").hide();
                $("#panelTablaVacunas").show();
                this.listarVacunas();

                Swal.fire({
                    title: "Vacuna registrada correctamente 🩺",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff",
                    timer: 1600
                });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }

    editarVacuna(){
        let objData = new FormData();
        objData.append("editarVacuna", "ok");
        objData.append("id_vacunas", this._objData.id_vacunas);
        objData.append("nombre_vacuna", this._objData.nombre_vacuna);
        objData.append("tiempo_aplicacion", this._objData.tiempo_aplicacion);

        fetch('controller/vacunasController.php', {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error =>{
            console.log(error);
        })
        .then(response =>{
            if(response["codigo"] == "200"){
                let formulario = document.getElementById('formEditarVacuna');
                formulario.reset();
                $("#panelFormularioEditarVacunas").hide();
                $("#panelTablaVacunas").show();
                this.listarVacunas();

                Swal.fire({
                    title: "Vacuna editada correctamente 🐾",
                    width: 600,
                    padding: "3em",
                    color: "#716add",
                    background: "#fff",
                    timer: 1600
                });
            }else{
                Swal.fire(response["mensaje"]);
            }
        })
    }
}
