<?php /* header.php */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Arcipreste de Hita</title>
  <style>
    body { margin:0; font-family: Arial, Helvetica, sans-serif; }
    .barra-superior {
      background:#000;
      color:#fff;
      padding:16px 0;
      text-align:center;
    }
    nav {
      display:flex;
      background:#000;
    }
    nav a {
      flex:1;
      text-align:center;
      padding:10px 0;
      text-decoration:none;
      color:#fff;
      border:1px solid #fff;
      font-weight:bold;
    }
    nav a:hover {
      background:#444;
    }
    .contenido {
      padding:12px;
    }
  </style>
</head>
<body>
  <div class="barra-superior">
    <h1 style="margin:0;">Arcipreste de Hita</h1>
  </div>

  <!-- Menú -->
  <nav>
    <a href="index.php">INICIO</a>
    <a href="servicios.php">SERVICIOS</a>
    <a href="contacto.php">CONTACTO</a>
    <a href="mapa.php">MAPA DEL SITIO</a>
  </nav>

  <div class="contenido">
