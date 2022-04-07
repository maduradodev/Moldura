<?php
  require_once 'includes/common.php';
  require_once 'includes/database.php';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=541px, initial-scale=1">
	<title>Foto com Moldura</title>
  <link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;700;800&display=swap" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
  
<nav class="navbar">
  
    <img src="img/logo.png" width="460" height="400" alt="Viatris logo">
  
</nav>

<main class="main">
  <div class="container">
    <div class="row">
      <div class="column">
        <h1 class="title">Clique no botão abaixo <br/> e faça sua pose</h1>
        <div class="camera-frame">
            <div class="countdown hidden" id="countdown"></div>
            
            <div class="placeholder">
              <img src="img/placeholder.jpg"/>
            </div>

            <div class="overlay-frame">
              <img class="" id="overlay" src="img/img.png" style="margin-left:137px;
  width: 78.4%;"/>
            </div>

            <div class="video-frame hidden" id="video-frame">
              <video style="width:100%;" playsinline autoplay></video>
            </div>
        </div>

        <div class="button-container">
          <button class="button" id="capture">
            <img src="img/camera.svg" width="30" height="30">
            Tirar foto
          </button>
        </div>
      </div>

      <div class="column">
        <h1 class="title" style="padding: 14px;">Sua foto</h1>
        <div class="result-frame">
          <div class="placeholder">
            <img src="img/placeholder.jpg"/>
          </div>

          <div class="overlay-frame" style="z-index:3;">
              <img class="" id="overlay" src="img/img.png" style="
  margin-left:137px;
  width: 78.4%;
  "/>
            </div>

          <div class="canvas-frame">
            <canvas class=""></canvas>
          </div>
        </div>

        <div class="button-container hidden" id="again">
          <button class="button" id="again">
            <img src="img/camera.svg" width="30" height="30">
            Tirar novamente
          </button>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="column">
        
      <div class="button-container hidden" id="save">
          <button class="button" id="save">
            <img src="img/save.svg" width="30" height="30">
            Salvar
          </button>
        </div>

      </div>
    </div>
  </div>
</main>
<script src="src/js.js" async></script>
</body>

</html>