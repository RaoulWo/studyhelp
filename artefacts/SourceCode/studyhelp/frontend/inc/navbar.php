<?php
$name2 = "Account";
$name3 = " Daten";
$name4 = "Freunde";
$name5 = " Einstellungen";
$name6 = "Sprache";
$name7 = "Deutsch";
$name8 = "Englisch";
$name10 = "Userverwaltung";
$name12 = "Profil";
$name13 = "logout";
$link2 = "../frontend/account.php";
$link3 = $link4 = $link5 = "#";
// Initialize variables with website names
$name1 = "Vokabelspiel";
// Initialize variables with website links
$link0 = "../frontend/index.php";
$link1 = "../frontend/game.php";
$link4 = "../frontend/freunde.php";
?>



<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <div class="container-fluid">
    <a href="<?php echo $link0; ?>" class="navbar-brand"><i class="fa-solid fa-graduation-cap"></i> STUDYHELP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?php echo $name1; ?></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo $link1; ?>"><?php echo $name1; ?></a></li>
            <!-- <li><a class="dropdown-item" href="#"><?php echo $name1; ?>2</a></li>
             <li><a class="dropdown-item" href="#"><?php echo $name1; ?>3</a></li> -->
          </ul>
        </li>
        <?php if ((isset($_SESSION["benutzer"]))) : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?php echo $name2; ?></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo $link2; ?>"><?php echo $name2, $name3; ?></a></li>
            <li><a class="dropdown-item" href="<?php echo $link4; ?>"><?php echo $name4; ?></a></li>
            <!-- <li><a class="dropdown-item" href="Link"><?php echo $name2, $name5; ?></a></li> -->
          </ul>
        </li>
        <?php endif ?>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?php echo $name6; ?></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="indexcadedeutsch.html"><?php echo $name7; ?></a></li>
            <li><a class="dropdown-item" href="indexcadeenglish.html"><?php echo $name8; ?></a></li>
          </ul>
        </li> -->
        <?php if (isset($_SESSION['benutzer']['benutzer_typ']) && $_SESSION['benutzer']['benutzer_typ'] == 'admin') : ?>
        <li class="nav-item"><a class="nav-link" href="../backend/userverwaltung.php"><?php echo $name10; ?></a></li>
        <li class="nav-item"><a class="nav-link" href="../backend/Vocabhandler.html">Vokabular hinzufügen</a></li>
        <?php endif ?>
      </ul>
    </div>
    <form class="d-flex">
      <!-- Button trigger modal -->
      <?php if (!(isset($_SESSION["benutzer"]))) : ?>
        <button type="button" id="loginModalToggler" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
          <?php echo $name12; ?>
        </button>
      <?php else: ?>
        <span class="navbar-text">
            <span>Sie sind jetzt als <a href="../frontend/account.php"><?php echo $_SESSION['benutzer']['username']; ?></a> eingelogged.
              Nicht <?php echo $_SESSION['benutzer']['username']; ?>?
              <a href="../frontend/index.php?logout=true" name="logout">Ausloggen</a></span>
        </span>
      <?php endif ?>
    </form>
  </div>
</nav>