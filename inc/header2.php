<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="img/r-redoma.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css?family=Cedarville+Cursive" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.google.com/specimen/Alegreya+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
  <title>Redoma</title>
  <link rel="stylesheet" href="css/agenda.css" />
  <link rel="stylesheet" href="css/mobile.css" />
</head>
<body>
  <header class="menu">
    <div class="empresa"><a href="index"><img src="img/logoredoma.png"/></a></div>

    <div class="hamburger" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
    
  </header>
    <nav class="nav-links" id="navLinks">
      <a href="#" onclick="closeMenu()"><b>Quem somos</b></a>
      <a href="index#onde" onclick="closeMenu()"><b>Onde estamos</b></a>
      <a href="formulario" onclick="closeMenu()"><b>Planejar evento</b></a>
      <a href="perguntas-frequentes" onclick="closeMenu()"><b>Dúvidas</b></a>
      <a href="#" onclick="closeMenu()"><b>Blog</b></a>
    </nav>