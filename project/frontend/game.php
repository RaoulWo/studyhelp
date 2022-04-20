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
  <section id="gameShowcase" class="bg-dark text-light p-5 p-lg-0 pb-lg-0 text-center text-sm-start">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between">
        <div>
          <h1><span class="text-warning">Vokabeln </span>spielerisch <span class="text-warning">lernen</span></h1>
          <p class="lead my-4">
            Vokabeln lernen leicht gemacht, ganz einfach eine Sprache auswählen und anschließend auf <span class="text-primary">Start</span> klicken!
          </p>
        </div>
        <img class="img-fluid w-50 d-none d-sm-block" src="res/img/gaming.svg" alt="">
      </div>
    </div>
  </section>

  <!-- Container for Language Select -->
  <div id="languageContainer" class="bg-dark text-light p-sm-5 p-5 ">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between">
        <div>
          <h2 class="d-sm-inline me-sm-5 text-sm-start text-center mb-4">Sprache wählen <i class="bi bi-hand-index-thumb"></i></h2>
          <div class="btn-group btn-group-toggle my-sm-4 flex-wrap" data-toggle="buttons">
            <label class="btn btn-outline-warning" for="english">
              <input type="radio" name="lang" id="english" autocomplete="off"> Englisch
            </label>
            <label class="btn btn-outline-warning">
              <input type="radio" name="lang" id="spanish" autocomplete="off"> Spanisch
            </label>
            <label class="btn btn-outline-warning">
              <input type="radio" name="lang" id="french" autocomplete="off"> Französisch
            </label>
            <label class="btn btn-outline-warning">
              <input type="radio" name="lang" id="russian" autocomplete="off"> Russisch
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Container for Timer and Points -->
  <div id="timerContainer" class="bg-dark text-light p-5 d-none">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between">
        <div class="mb-sm-0 mb-4">
          <h2><i class="bi bi-hourglass-split"></i>  <span id="timer">50</span> Sekunden</h2>
        </div>
        <div class="">
          <h2><i class="fa-solid fa-coins"></i> <span id="points">0</span> Punkte</h2>
        </div>
      </div>
    </div>
  </div>


  <!-- Container for Game -->
  <div class="p-5">
    <div id="gameContainer" class="container">
      <!-- Container for Start -->
      <div id="gameStart">
        <h1 class="display-1 text-primary text-center">Start</h1>
      </div>

      <!-- Container for Answers -->
      <div id="gameCards" class="container d-none">
        <!-- Row 1 -->
        <div class="row text-center g-4 mb-5">
          <div id="questionContainer" class="col-md">
            <div class="card border-3 border-primary">
              <div class="card-body text-center p-4">
                <div class="h1 mb-4">
                  <i class="fa-solid fa-book-open"></i>                
                </div>
                <h3 id="question" class="card-title">Test</h3>
              </div>
            </div>
          </div>

        </div>

        <!-- Row 2 -->
        <div class="row text-center g-4 mb-4">
          <!-- Card 1 -->
          <div id="answer1Container" class="col-md">
            <div class="card bg-secondary text-light">
              <div class="card-body text-center p-4">
                <div class="h1 mb-4">
                  <i class="fa-solid fa-1"></i>                
                </div>
                <h3 id="answer1" class="card-title">Test</h3>
              </div>
            </div>
          </div>
          <!-- Card 2 -->
          <div id="answer2Container" class="col-md">
            <div class="card bg-secondary text-light">
              <div class="card-body text-center p-4">
                <div class="h1 mb-4">
                  <i class="fa-solid fa-2"></i>
                </div>
                <h3 id="answer2" class="card-title">Test</h3>
              </div>
            </div>
          </div>
        </div>

        <!-- Row 3 -->
        <div class="row text-center g-4">
          <!-- Card 3 -->
          <div id="answer3Container" class="col-md">
            <div class="card bg-secondary text-light">
              <div class="card-body text-center p-4">
                <div class="h1 mb-4">
                  <i class="fa-solid fa-3"></i>
                </div>
                <h3 id="answer3" class="card-title">Test</h3>
              </div>
            </div>
          </div>
          <!-- Card 4 -->
          <div id="answer4Container" class="col-md">
            <div class="card bg-secondary text-light">
              <div class="card-body text-center p-4">
                <div class="h1 mb-4">
                  <i class="fa-solid fa-4"></i>
                </div>
                <h3 id="answer4" class="card-title">Test</h3>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
      

  














    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- JavaScript for Bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Own JavaScript -->
    <script src="scripts/game.js"></script>
</body>
</html>