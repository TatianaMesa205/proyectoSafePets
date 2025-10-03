class Musuario {
    constructor(objData){
        this._objData = objData;
    }
    listarMusuarios(){
        let objData = new FormData();
        objData.append("listarMusuarios",this._objData.listarMusuarios);

        fetch("controller/musuarioControlador.php",{
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

                response["listaMusuarios"].forEach(item => {
                    let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += '<button id="btn-editarMusuario" type="button" style="background-color:pink; border-color:pink; color:white" class="btn" mascota="'+item.idmascota+'" nombre="'+item.nombre+'"  edad="'+item.edad+'"><i class="bi bi-pencil"></i></button>';
                    objBotones += '<button id="btn-eliminarMusuario" type="button" style="background-color:rgb(158,147,223); color:white" class="btn" mascota="'+item.idmascota+'"><i class="bi bi-trash"></i></button>';
                    objBotones += '</div>';

                    dataSet.push([
                        item.nombre,
                        item.edad,
                        item.usuario,
                        item.tipo_mascota,
                        item.raza,
                        objBotones
                    ]);
                });

                $("#tablaMusuarios").DataTable({
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



  eliminarMusuario(){
      let objData = new FormData();
      objData.append("eliminarMusuario",this._objData.eliminarMusuario);
      objData.append("idMascota",this._objData.idMascota);
      fetch("controller/musuarioControlador.php",{
          method: 'POST',
          body: objData
      })
      .then(response => response.json()).catch(error => {
          console.log(error);
      })
      .then(response =>{
          if (response["codigo"] == "200"){
              this.listarMusuarios();
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

  registrarMusuario(){

      console.log(this._objData.registrarMusuario);

      let objDataMusuario = new FormData();
      objDataMusuario.append("registrarMusuario",this._objData.registrarMusuario);
      objDataMusuario.append("nombreM",this._objData.nombreM);
      objDataMusuario.append("edadM",this._objData.edadM);
      objDataMusuario.append("usuario_id", this._objData.usuario_id);
      objDataMusuario.append("raza_id", this._objData.raza_id);
      objDataMusuario.append("tipo_mascota_id", this._objData.tipo_mascota_id);


      fetch('controller/musuarioControlador.php',{
          method: 'POST',
          body:objDataMusuario
      })
      .then(response => response.json()).catch(error =>{
          console.log(error);
      })
      .then(response =>{

          if(response["codigo"] == "200"){
              let formulario = document.getElementById('formRegistroMusuarios');
              formulario.reset();
              $("#panelFormularioMusuarios").hide();
              $("#panelTablaMusuarios").show();
              this.listarMusuarios();

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


  editarMusuario(){

      let objDataMusuario = new FormData();
      objDataMusuario.append("editarMusuario",this._objData.editarMusuario);
      objDataMusuario.append("idMascota",this._objData.idMascota);
      objDataMusuario.append("nombreM",this._objData.nombreM);
      objDataMusuario.append("edadM",this._objData.edadM);
      fetch('controller/musuarioControlador.php',{
          method: 'POST',
          body:objDataMusuario
      })
      .then(response => response.json()).catch(error =>{
          console.log(error);
      })
      .then(response =>{

          if(response["codigo"] == "200"){
              let formulario = document.getElementById('formEditarMusuarios');
              formulario.reset();
              $("#panelFormularioEditarMusuarios").hide();
              $("#panelTablaMusuarios").show();
              this.listarMusuarios();

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








//SELECTS FORMULARIO MASCOTAS:   USUARIOS - RAZAS - TIPOS //



  cargarSelects() {
      this.cargarUsuarios();
      this.cargarRazas();
      this.cargarTiposMascota();
  }

  cargarUsuarios() {
      let objData = new FormData();
      objData.append("listarUsuarios", "ok");

      fetch("controller/usuarioControlador.php", {
          method: 'POST',
          body: objData
      })
      .then(response => response.json())
      .then(response => {
          if (response["codigo"] == "200") {
              let select = document.getElementById('select_usuario');
              select.innerHTML = '<option value="">Seleccione un usuario</option>';
              
              response["listaUsuarios"].forEach(usuario => {
                  select.innerHTML += `<option value="${usuario.idusuario}">${usuario.nombre} ${usuario.apellido}</option>`;
              });
          }
      })
      .catch(error => console.log(error));
  }

  cargarRazas() {
      let objData = new FormData();
      objData.append("listarRaza", "ok");

      fetch("controller/razaControlador.php", {
          method: 'POST',
          body: objData
      })
      .then(response => response.json())
      .then(response => {
          if (response["codigo"] == "200") {
              let select = document.getElementById('select_raza');
              select.innerHTML = '<option value="">Seleccione una raza</option>';
              
              response["listaRazas"].forEach(raza => {
                  select.innerHTML += `<option value="${raza.idraza}">${raza.descripcion_raza}</option>`;
              });
          }
      })
      .catch(error => console.log(error));
  }

  cargarTiposMascota() {
      let objData = new FormData();
      objData.append("listarTmascotas", "ok");

      fetch("controller/tmascotaControlador.php", {
          method: 'POST',
          body: objData
      })
      .then(response => response.json())
      .then(response => {
          if (response["codigo"] == "200") {
              let select = document.getElementById('select_tipo_mascota');
              select.innerHTML = '<option value="">Seleccione un tipo de mascota</option>';
              
              response["listaTmascotas"].forEach(tipo => {
                  select.innerHTML += `<option value="${tipo.idtipo_mascota}">${tipo.descripcion}</option>`;
              });
          }
      })
      .catch(error => console.log(error));
  }
}
    
    
    
    
    
    
    
    