<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Safe Pets</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>

    /* fondo general y tipografía. */
    body {
      margin: 0; /* Elimina márgenes por defecto */
      font-family: "Poppins", sans-serif; /* Fuente moderna */
      background-color: #f9f6f6; /* Fondo gris muy claro */
    }


    /* sección descriptiva con imagen + texto. */
    .about {
      display: flex; /* Organiza imagen + texto en fila */
      justify-content: center; /* Centra horizontalmente */
      align-items: center; /* Centra verticalmente */
      gap: 30px; /* Espacio entre imagen y texto */
      padding: 50px; /* Espaciado interno */
      background-color: #f9f4f3; /* Fondo beige claro */
      border-radius: 20px; /* Bordes redondeados */
      margin: 30px; /* Espaciado externo */
    }
    .about img {
      width: 300px; /* Tamaño fijo de ancho */
      height: 300px; /* Tamaño fijo de alto */
      border-radius: 15px; /* Bordes redondeados */
      object-fit: cover; /* Recorta la imagen sin deformarla */
    }
    .about-text {
      max-width: 600px; /* Ancho máximo del texto */
      text-align: justify; /* Texto justificado */
    }
    .about-text h2 {
      text-align: center; /* Centrado */
      margin-bottom: 20px; /* Espacio inferior */
    }




  </style>
</head>
<body>

<section class="about">
    <img src="https://images.pexels.com/photos/4012470/pexels-photo-4012470.jpeg" alt="gatitos">
    <div class="about-text">
      <h2>𝐀𝐦𝐨𝐫 𝐪𝐮𝐞 𝐭𝐫𝐚𝐧𝐬𝐟𝐨𝐫𝐦𝐚 𝐯𝐢𝐝𝐚𝐬 <i class="fa-solid fa-paw"></i></h2>
      <p>
        𝐒𝐨𝐦𝐨𝐬 𝐮𝐧𝐚 𝐅𝐮𝐧𝐝𝐚𝐜𝐢ó𝐧 𝐪𝐮𝐞 𝐛𝐮𝐬𝐜𝐚 𝐥𝐚 𝐩𝐫𝐨𝐭𝐞𝐜𝐜𝐢ó𝐧, 𝐫𝐞𝐬𝐜𝐚𝐭𝐞 𝐲 𝐛𝐢𝐞𝐧𝐞𝐬𝐭𝐚𝐫 𝐝𝐞 𝐩𝐞𝐫𝐫𝐨𝐬 𝐲 𝐠𝐚𝐭𝐨𝐬 𝐞𝐧 𝐬𝐢𝐭𝐮𝐚𝐜𝐢ó𝐧 
        𝐝𝐞 𝐚𝐛𝐚𝐧𝐝𝐨𝐧𝐨, 𝐦𝐚𝐥𝐭𝐫𝐚𝐭𝐨 𝐨 𝐯𝐮𝐥𝐧𝐞𝐫𝐚𝐛𝐢𝐥𝐢𝐝𝐚𝐝. 𝐍𝐮𝐞𝐬𝐭𝐫𝐚 𝐦𝐢𝐬𝐢ó𝐧 𝐞𝐬 𝐛𝐫𝐢𝐧𝐝𝐚𝐫𝐥𝐞𝐬 𝐮𝐧𝐚 𝐬𝐞𝐠𝐮𝐧𝐝𝐚 𝐨𝐩𝐨𝐫𝐭𝐮𝐧𝐢𝐝𝐚𝐝 𝐚 𝐭𝐫𝐚𝐯é𝐬 𝐝𝐞𝐥 𝐫𝐞𝐬𝐜𝐚𝐭𝐞, 
        𝐥𝐚 𝐫𝐞𝐜𝐮𝐩𝐞𝐫𝐚𝐜𝐢ó𝐧 𝐲 𝐥𝐚 𝐛ú𝐬𝐪𝐮𝐞𝐝𝐚 𝐝𝐞 𝐡𝐨𝐠𝐚𝐫𝐞𝐬 𝐫𝐞𝐬𝐩𝐨𝐧𝐬𝐚𝐛𝐥𝐞𝐬 𝐲 𝐚𝐦𝐨𝐫𝐨𝐬𝐨𝐬.
      </p>
      <p>
        𝐏𝐫𝐨𝐦𝐨𝐯𝐞𝐦𝐨𝐬 𝐥𝐚 𝐞𝐝𝐮𝐜𝐚𝐜𝐢ó𝐧 𝐬𝐨𝐛𝐫𝐞 𝐭𝐞𝐧𝐞𝐧𝐜𝐢𝐚 𝐫𝐞𝐬𝐩𝐨𝐧𝐬𝐚𝐛𝐥𝐞, 𝐞𝐥 𝐫𝐞𝐬𝐩𝐞𝐭𝐨 𝐩𝐨𝐫 𝐥𝐚 𝐯𝐢𝐝𝐚 𝐚𝐧𝐢𝐦𝐚𝐥 𝐲 𝐟𝐨𝐦𝐞𝐧𝐭𝐚𝐦𝐨𝐬 
        𝐜𝐚𝐦𝐩𝐚ñ𝐚𝐬 𝐝𝐞 𝐞𝐬𝐭𝐞𝐫𝐢𝐥𝐢𝐳𝐚𝐜𝐢ó𝐧 𝐜𝐨𝐦𝐨 𝐞𝐬𝐭𝐫𝐚𝐭𝐞𝐠𝐢𝐚 𝐜𝐥𝐚𝐯𝐞 𝐩𝐚𝐫𝐚 𝐫𝐞𝐝𝐮𝐜𝐢𝐫 𝐥𝐚 𝐬𝐨𝐛𝐫𝐞𝐩𝐨𝐛𝐥𝐚𝐜𝐢ó𝐧 𝐜𝐚𝐥𝐥𝐞𝐣𝐞𝐫𝐚.
      </p>
      <p>
        𝐂𝐫𝐞𝐞𝐦𝐨𝐬 𝐪𝐮𝐞 𝐜𝐚𝐝𝐚 𝐯𝐢𝐝𝐚 𝐢𝐦𝐩𝐨𝐫𝐭𝐚, 𝐲 𝐩𝐨𝐫 𝐞𝐬𝐨, 𝐝í𝐚 𝐚 𝐝í𝐚, 𝐮𝐧𝐢𝐦𝐨𝐬 𝐟𝐮𝐞𝐫𝐳𝐚𝐬 𝐩𝐚𝐫𝐚 𝐜𝐚𝐦𝐛𝐢𝐚𝐫 𝐥𝐚 𝐫𝐞𝐚𝐥𝐢𝐝𝐚𝐝 𝐝𝐞 
        𝐜𝐢𝐞𝐧𝐭𝐨𝐬 𝐝𝐞 𝐚𝐧𝐢𝐦𝐚𝐥𝐞𝐬 𝐪𝐮𝐞 𝐦𝐞𝐫𝐞𝐜𝐞𝐧 𝐮𝐧𝐚 𝐯𝐢𝐝𝐚 𝐝𝐢𝐠𝐧𝐚 𝐲 𝐥𝐥𝐞𝐧𝐚 𝐝𝐞 𝐚𝐦𝐨𝐫.
      </p>
    </div>
  </section>

  <?php include 'flooter.php'; ?>
  
</body>
</html>
