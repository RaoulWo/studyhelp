<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("inc/metaData.php"); ?>
  <title>Game</title>
</head>
<body>
  <!-- Include Navbar -->
  <?php include("inc/navbar.php"); ?>

  <!-- Showcase -->
  <section class="bg-dark text-light p-5 p-lg-0 pb-lg-0 text-center text-sm-start">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between">
        <div>
          <h1><span class="text-warning">Vokabeln </span>spielerisch <span class="text-warning">lernen</span></h1>
          <p class="lead my-4">
              Lorem ipsum dolor sit amet, consetetur sadipscing elitr, 
              sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
              sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 
              Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
          </p>
        </div>
        <img class="img-fluid w-50 d-none d-sm-block" src="res/img/gaming.svg" alt="">
      </div>
    </div>
  </section>

  <!-- Container for Language Select -->
  <div class="bg-dark text-light p-5 pt-3">
    <div id="languageSelect" class="container">
      <h2 class="text-center text-warning">Sprachen auswählen</p>
      <div class="row mt-5">
        <div class="col-sm-3 py-sm-0 py-3">
        <button id="german" class="btn btn-lg btn-primary">Deutsch</button>
        </div>
        <div class="col-sm-3 py-sm-0 py-3">
          <button id="english" class="btn btn-lg btn-primary">Englisch</button>
        </div>
        <div class="col-sm-3 py-sm-0 py-3">
          <button id="spanish" class="btn btn-lg btn-primary">Spanisch</button>
        </div>
        <div class="col-sm-3 py-sm-0 py-3">
          <button id="french" class="btn btn-lg btn-primary">Französisch</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Container for Timer -->
  <div class="p-5">
    <div id="timer" class="container p-5">

    </div>
  </div>


  <!-- Container for Game -->
  <div class="p-5">
    <div id="gameSpace" class="container p-5">
      <h1 id="gameStart" class="display-1 text-center">Start</p>
    </div>
  </div>
  
</body>
</html>