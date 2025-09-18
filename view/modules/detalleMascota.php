<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mascotas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f2f0;
      margin: 0;
      padding: 20px;
      text-align: center;
    }

    /* Tarjetas */
    .cards-container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      justify-items: center;
    }

    .card {
      width: 220px;
      cursor: pointer;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .card h3 {
      margin: 10px;
      font-size: 18px;
    }

    /* Modal */
    .modal {
      display: none; /* oculto por defecto */
      position: fixed;
      z-index: 999;
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
    .modal-content h2 {
      text-align: center;
    }
    .close {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <h1>🐾 Mascotas en adopción</h1>

  <!-- Tarjetas -->
  <div class="cards-container">
    <div class="card" onclick="openModal('Thor')">
      <img src="thor.jpg" alt="Thor">
      <h3>Thor</h3>
    </div>

    <div class="card" onclick="openModal('Luna')">
      <img src="luna.jpg" alt="Luna">
      <h3>Luna</h3>
    </div>
  </div>

  <!-- Modal -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <img id="modal-img" src="" alt="">
      <div id="modal-info"></div>
    </div>
  </div>

  <script>
    // Datos de mascotas (simulación de base de datos)
    const mascotas = {
      "Thor": {
        img: "thor.jpg",
        nombre: "Thor",
        especie: "Perro",
        raza: "Mezcla de pastor alemán con lobo siberiano",
        edad: "2 años",
        sexo: "Macho",
        tamaño: "Grande",
        fechaIngreso: "2023-05-14",
        salud: "Desparasitado, vacunado y esterilizado",
        estado: "Disponible",
        historia: "Thor fue encontrado en las afueras de la ciudad..."
      },
      "Luna": {
        img: "luna.jpg",
        nombre: "Luna",
        especie: "Perro",
        raza: "Labrador Retriever",
        edad: "3 años",
        sexo: "Hembra",
        tamaño: "Mediana",
        fechaIngreso: "2024-01-20",
        salud: "Vacunada, desparasitada",
        estado: "En proceso",
        historia: "Luna fue rescatada de un parque..."
      }
    };

    // Función para abrir el modal
    function openModal(nombre) {
      const m = mascotas[nombre];
      document.getElementById("modal-img").src = m.img;
      document.getElementById("modal-info").innerHTML = `
        <h2>${m.nombre}</h2>
        <p><b>Especie:</b> ${m.especie}</p>
        <p><b>Raza:</b> ${m.raza}</p>
        <p><b>Edad:</b> ${m.edad}</p>
        <p><b>Sexo:</b> ${m.sexo}</p>
        <p><b>Tamaño:</b> ${m.tamaño}</p>
        <p><b>Fecha de ingreso:</b> ${m.fechaIngreso}</p>
        <p><b>Estado de salud:</b> ${m.salud}</p>
        <p><b>Estado:</b> ${m.estado}</p>
        <h3>Historia</h3>
        <p>${m.historia}</p>
      `;
      document.getElementById("modal").style.display = "flex";
    }

    // Función para cerrar el modal
    function closeModal() {
      document.getElementById("modal").style.display = "none";
    }
  </script>
</body>
</html>
