class Mascota {
    constructor(objData){
        this._objData = objData;
    }
    listarMascotas(){
        let objData = new FormData();
        objData.append("listarMascotas",this._objData.listarMascotas);

        fetch("controller/mascotaController.php",{
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

                response["listaMascotas"].forEach(item => {
                    let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += '<button id="btn-editarMascota" type="button" style="background-color:pink; border-color:pink; color:white" class="btn" mascota="'+item.id_mascotas+'" nombre="'+item.nombre+'" especie="'+item.especie+'" raza="'+item.raza+'" edad="'+item.edad+'" sexo="'+item.sexo+'" tamaño="'+item.tamaño+'" fecha_ingreso="'+item.fecha_ingreso+'" estado_salud="'+item.estado_salud+'" estado="'+item.estado+'" descripcion="'+item.descripcion+'" imagen="'+item.imagen+'"><i class="bi bi-pencil"></i></button>';
                    objBotones += '<button id="btn-eliminarMascota" type="button" style="background-color:rgb(158,147,223); color:white" class="btn" mascota="'+item.id_mascotas+'"><i class="bi bi-trash"></i></button>';
                    objBotones += '</div>';

                    dataSet.push([
                        item.nombre,
                        item.especie,
                        item.raza,
                        item.edad,
                        item.sexo,
                        item.tamaño,
                        item.fecha_ingreso,
                        item.estado_salud,
                        item.estado,
                        item.descripcion,
                        item.imagen,
                        objBotones
                    ]);
                });

                $("#tablaMascotas").DataTable({
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



  eliminarMascota(){
      let objData = new FormData();
      objData.append("eliminarMascota",this._objData.eliminarMascota);
      objData.append("id_mascotas",this._objData.id_mascotas);
      fetch("controller/mascotasController.php",{
          method: 'POST',
          body: objData
      })
      .then(response => response.json()).catch(error => {
          console.log(error);
      })
      .then(response =>{
          if (response["codigo"] == "200"){
              this.listarMascotas();
              Swal.fire({
                  title: "Mascota eliminada correctamente :(",
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

  registrarMascota(){

      console.log(this._objData.registrarMascota);

      let objDataMascota = new FormData();
      objDataMascota.append("registrarMascota",this._objData.registrarMascota);
      objDataMascota.append("nombre",this._objData.nombre);
      objDataMascota.append("especie",this._objData.especie);
      objDataMascota.append("raza",this._objData.raza);
      objDataMascota.append("edad",this._objData.edad);
      objDataMascota.append("sexo",this._objData.sexo);
      objDataMascota.append("tamaño",this._objData.tamaño);
      objDataMascota.append("fecha_ingreso",this._objData.fecha_ingreso);
      objDataMascota.append("estado_salud",this._objData.estado_salud);
      objDataMascota.append("estado",this._objData.estado);
      objDataMascota.append("descripcion",this._objData.descripcion);
      objDataMascota.append("imagen",this._objData.imagen);


      fetch('controller/mascotaController.php',{
          method: 'POST',
          body:objDataMusuario
      })
      .then(response => response.json()).catch(error =>{
          console.log(error);
      })
      .then(response =>{

          if(response["codigo"] == "200"){
              let formulario = document.getElementById('formRegistroMascotas');
              formulario.reset();
              $("#panelFormularioMascotas").hide();
              $("#panelTablaMascotas").show();
              this.listarMascotas();

                Swal.fire({
                  title: "Mascota registrada correctamente :D",
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


  editarMascota(){

      let objDataMascota = new FormData();
      objDataMascota.append("editarMascota",this._objData.editarMascota);
      objDataMascota.append("id_mascotas",this._objData.id_mascotas);
      objDataMascota.append("nombre",this._objData.nombre);
      objDataMascota.append("especie",this._objData.especie);
      objDataMascota.append("raza",this._objData.raza);
      objDataMascota.append("edad",this._objData.edad);
      objDataMascota.append("sexo",this._objData.sexo);
      objDataMascota.append("tamaño",this._objData.tamaño);
      objDataMascota.append("fecha_ingreso",this._objData.fecha_ingreso);
      objDataMascota.append("estado_salud",this._objData.estado_salud);
      objDataMascota.append("estado",this._objData.estado);
      objDataMascota.append("descipcion",this._objData.descipcion);
      objDataMascota.append("imagen",this._objData.imagen);

      fetch('controller/mascotaController.php',{
          method: 'POST',
          body:objDataMascota
      })
      .then(response => response.json()).catch(error =>{
          console.log(error);
      })
      .then(response =>{

          if(response["codigo"] == "200"){
              let formulario = document.getElementById('formEditarMascotas');
              formulario.reset();
              $("#panelFormularioEditarMascotas").hide();
              $("#panelTablaMascotas").show();
              this.listarMascotas();

                Swal.fire({
                  title: "Mascota editada correctamente :D",
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

}  
    