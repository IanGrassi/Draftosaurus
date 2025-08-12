<?php include '../SEGURIDAD/proteccion.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="../RECURSOS/CSS/style_juego.css">
  <title>Partida</title>

  <style>
    .tablero {
      background-image: url("../RECURSOS/IMAGENES/SpriteTablero.png");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      width: 65%;
      height: 79%;
      border: 7px solid rgba(255, 255, 255, 1);
      position: relative;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("../RECURSOS/IMAGENES/fondoInicio.png");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      filter: blur(8px) brightness(0.7);
      z-index: -1;
    }
  </style>

</head>
<body>
  <div class="tablero" id="tablero">
    <div class="region region-top-left dropzone"></div>
    <div class="region region-top-right dropzone"></div>
    <div class="region region-middle-left dropzone"></div>
    <div class="region region-middle-right dropzone"></div>
    <div class="region region-bottom-left dropzone"></div>
    <div class="region region-bottom-right dropzone"></div>
    <div class="region region-center dropzone"></div>
  </div>

  <div class="tab" id="TomaDinosaurios">
    <div class="draggable" draggable="true"><img src="../RECURSOS/IMAGENES/DinoRojoSprite.png" alt="DinoRojo"></div>
    <div class="draggable" draggable="true"><img src="../RECURSOS/IMAGENES/DinoAzulSprite.png" alt="DinoAzul"></div>
    <div class="draggable" draggable="true"><img src="../RECURSOS/IMAGENES/DinoAmarilloSprite.png" alt="DinoAmarillo"></div>
    <div class="draggable" draggable="true"><img src="../RECURSOS/IMAGENES/DinoNaranjaSprite.png" alt="DinoNaranja"></div>
    <div class="draggable" draggable="true"><img src="../RECURSOS/IMAGENES/DinoVerdeSprite.png" alt="DinoVerde"></div>
    <div class="draggable" draggable="true"><img src="../RECURSOS/IMAGENES/DinoVioletaSprite.png" alt="DinoVioleta"></div>

    <br>

    <input class="BotonRedireccionInicio" type="button" value="Regresar" onclick="window.location.href='../BACK/logout.php'" />

    <input class="BotonRedireccionCambio" type="button" value="Cambiar de turno"/>

    <input class="BotonRedireccionObtenerDinos" type="button" value="Obtener dinosauruios"/>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', () => {
  const btnObtener = document.getElementById('btn-obtener-dinos');
  const dinosContainer = document.getElementById('zona-dinos');
  const todosDinos = Array.from(dinosContainer.querySelectorAll('.draggable'));

  // Al iniciar ocultamos todos
  todosDinos.forEach(d => d.style.display = 'none');

  btnObtener.addEventListener('click', () => {
    // Ocultamos todos antes de mostrar los nuevos
    todosDinos.forEach(d => d.style.display = 'none');

    // Mezclamos aleatoriamente
    const seleccionados = [...todosDinos].sort(() => Math.random() - 0.5).slice(0, 6);

    // Mostramos los seleccionados
    seleccionados.forEach(d => d.style.display = 'inline-block');
  });
});
  
    // Hacer que los elementos se puedan arrastrar
    document.querySelectorAll(".draggable").forEach(item => {
      item.addEventListener("dragstart", e => {
        e.dataTransfer.setData("text/html", item.outerHTML);
        e.dataTransfer.effectAllowed = "move";
        // Guardar origen para evitar duplicado
        item.classList.add("drag-source");
      });

      item.addEventListener("dragend", () => {
        item.classList.remove("drag-source");
      });
    });

    // Hacer que las regiones acepten drops
    document.querySelectorAll(".dropzone").forEach(zone => {
      zone.addEventListener("dragover", e => {
        e.preventDefault();
        zone.style.backgroundColor = "rgba(255,255,255,0.1)";
      });

      zone.addEventListener("dragleave", () => {
        zone.style.backgroundColor = "transparent";
      });

      zone.addEventListener("drop", e => {
        e.preventDefault();
        zone.style.backgroundColor = "transparent";

        const data = e.dataTransfer.getData("text/html");

        // Evitar duplicado si ya está en zona
        const source = document.querySelector(".drag-source");
        if (source && source.parentElement !== zone) {
          const clone = source.cloneNode(true);
          clone.classList.remove("drag-source");
          clone.draggable = true;

          // Volver a agregar eventos
          clone.addEventListener("dragstart", e => {
            e.dataTransfer.setData("text/html", clone.outerHTML);
            clone.classList.add("drag-source");
          });
          clone.addEventListener("dragend", () => {
            clone.classList.remove("drag-source");
          });

          zone.appendChild(clone);
        }
      });
    });

  </script>
</body>
</html>

