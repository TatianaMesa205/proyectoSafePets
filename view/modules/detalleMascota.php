<style>
    /* Estilos para las tarjetas y el modal de detalles */
    .detalle-container {
        padding: 20px;
        text-align: center;
    }
    /* ... (puedes agregar más estilos específicos aquí si los necesitas) ... */
    .modal {
      display: none; 
      position: fixed;
      z-index: 1050; /* Z-index alto para estar sobre todo */
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
    }
    .modal-content {
      background: #dbe4f0;
      padding: 20px;
      border-radius: 15px;
      width: 70%;
      max-width: 800px;
      text-align: left;
      position: relative;
    }
    .modal-content img {
      float: left;
      margin-right: 20px;
      width: 200px;
      height: 200px;
      object-fit: cover;
      border-radius: 15px;
    }
    .close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      cursor: pointer;
    }
</style>

<div class="detalle-container">
    <h1>🐾 Conoce más sobre tu futuro amigo</h1>
    <p>Haz clic en una mascota para ver sus detalles.</p>

    </div>

<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <img id="modal-img" src="" alt="Foto de la mascota">
    <div id="modal-info"></div>
  </div>
</div>

<script>
    // Simulación de datos de la base de datos
    const mascotas = {
      "1": { img: "uploads/p1.jpeg", nombre: "Zeus", especie: "Perro", raza: "Mezcla", edad: "2 años", sexo: "Macho", tamaño: "Grande", historia: "Fue encontrado muy juguetón." },
      "2": { img: "uploads/g1.jpeg", nombre: "Luna", especie: "Gato", raza: "Mezcla", edad: "3 años", sexo: "Hembra", tamaño: "Pequeño", historia: "Le encantan los mimos." }
      // ... (Aquí cargarías todas las mascotas desde tu base de datos)
    };

    // Función para abrir el modal
    function openModal(id) {
      const m = mascotas[id];
      if (!m) { console.error("Mascota no encontrada"); return; }
      
      document.getElementById("modal-img").src = m.img;
      document.getElementById("modal-info").innerHTML = `
        <h2>${m.nombre}</h2>
        <p><b>Especie:</b> ${m.especie}</p>
        <p><b>Raza:</b> ${m.raza}</p>
        <p><b>Edad:</b> ${m.edad}</p>
        <p><b>Sexo:</b> ${m.sexo}</p>
        <p><b>Tamaño:</b> ${m.tamaño}</p>
        <h3>Historia</h3>
        <p>${m.historia}</p>
      `;
      document.getElementById("modal").style.display = "flex";
    }

    // Función para cerrar el modal
    function closeModal() {
      document.getElementById("modal").style.display = "none";
    }
    
    // Simular la apertura del modal basado en el ID de la URL
    window.onload = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        if (id) {
            openModal(id);
        }
    };
</script>

