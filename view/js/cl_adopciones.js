class Adopciones {
    constructor(objData){
        this._objData = objData;
    }

    listarAdopciones(){
        let objData = new FormData();
        objData.append("listarAdopciones", this._objData.listarAdopciones);

        fetch("controller/adopcionesController.php",{
            method:'POST',
            body:objData
        })
        .then(r=>r.json()).catch(e=>console.log(e))
        .then(response=>{
            if(response["codigo"]=="200"){
                let dataSet = [];
                response["listaAdopciones"].forEach(item=>{
                    let botones = `
                        <div class="btn-group">
                          <button id="btn-editarAdopcion" class="btn" style="background-color:pink;border-color:pink;color:white"
                            adopcion="${item.id_adopciones}"
                            mascota="${item.id_mascotas}"
                            adoptante="${item.id_adoptantes}"
                            fecha="${item.fecha_adopcion}"
                            estado="${item.estado}"
                            observaciones="${item.observaciones}"
                            contrato="${item.contrato}">
                            <i class="bi bi-pencil"></i>
                          </button>
                          <button id="btn-eliminarAdopcion" class="btn" style="background-color:rgb(158,147,223);color:white"
                            adopcion="${item.id_adopciones}">
                            <i class="bi bi-trash"></i>
                          </button>
                        </div>`;
                    dataSet.push([
                        item.id_mascotas,
                        item.id_adoptantes,
                        item.fecha_adopcion,
                        item.estado,
                        item.observaciones,
                        item.contrato,
                        botones
                    ]);
                });
                $("#tablaAdopciones").DataTable({
                    destroy:true,
                    responsive:true,
                    dom:"Bfrtip",
                    buttons:["colvis","excel","pdf","print"],
                    data:dataSet
                });
            }
        });
    }

    eliminarAdopcion(){
        let objData = new FormData();
        objData.append("eliminarAdopcion", this._objData.eliminarAdopcion);
        objData.append("id_adopciones", this._objData.id_adopciones);

        fetch("controller/adopcionesController.php", {method:'POST',body:objData})
        .then(r=>r.json()).then(response=>{
            if(response["codigo"]=="200"){
                this.listarAdopciones();
                Swal.fire({
                    title:"Adopción eliminada correctamente 🐾",
                    color:"#ba88d1",
                    background:"#fff",
                    timer:1500
                });
            }else Swal.fire(response["mensaje"]);
        });
    }

    registrarAdopcion(){
        let objData = new FormData();
        objData.append("registrarAdopcion","ok");
        objData.append("mascotas_id",this._objData.mascotas_id);
        objData.append("adoptantes_id",this._objData.adoptantes_id);
        objData.append("fecha_adopcion",this._objData.fecha_adopcion);
        objData.append("estado",this._objData.estado);
        objData.append("observaciones",this._objData.observaciones);
        objData.append("contrato",this._objData.contrato);

        fetch("controller/adopcionesController.php",{method:'POST',body:objData})
        .then(r=>r.json()).then(response=>{
            if(response["codigo"]=="200"){
                document.getElementById("formRegistroAdopcion").reset();
                $("#panelFormularioAdopciones").hide();
                $("#panelTablaAdopciones").show();
                this.listarAdopciones();
                Swal.fire({title:"Adopción registrada 🐶",timer:1600});
            }else Swal.fire(response["mensaje"]);
        });
    }

    editarAdopcion(){
        let objData = new FormData();
        objData.append("editarAdopcion","ok");
        objData.append("id_adopciones",this._objData.id_adopciones);
        objData.append("mascotas_id",this._objData.mascotas_id);
        objData.append("adoptantes_id",this._objData.adoptantes_id);
        objData.append("fecha_adopcion",this._objData.fecha_adopcion);
        objData.append("estado",this._objData.estado);
        objData.append("observaciones",this._objData.observaciones);
        objData.append("contrato",this._objData.contrato);

        fetch("controller/adopcionesController.php",{
            method:'POST',
            body:objData
        })
        .then(r=>r.json())
        .then(response=>{
            if(response["codigo"]=="200"){
                document.getElementById("formEditarAdopcion").reset();
                $("#panelFormularioEditarAdopciones").hide();
                $("#panelTablaAdopciones").show();
                this.listarAdopciones();
                Swal.fire({
                    title:"Adopción editada correctamente 😺"
                });
            } else {
                Swal.fire(response["mensaje"]);
            }
        });
    }
}
