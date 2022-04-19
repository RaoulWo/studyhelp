<?php 
  $name0 = $name1 = $name2 = $name3 = $name4 = $name5 = "link";
  $link0 = $link1 = $link2 = $link3 = $link4 = $link5 = "#";
  // Initialize variables with website names
  $name0 = "STUDYHELP";
  $name1 = "Game";
  // Initialize variables with website links
  $link0 = "index.php";
  $link1 = "game.php";
?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3">
  <div class="container">
    <a href="<?php echo $link0; ?>" class="navbar-brand"><?php echo $name0; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="navmenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navmenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="<?php echo $link1; ?>" class="nav-link"><?php echo $name1; ?></a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $link2; ?>" class="nav-link"><?php echo $name2; ?></a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $link3; ?>" class="nav-link"><?php echo $name3; ?></a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $link4; ?>" class="nav-link"><?php echo $name4; ?></a>
        </li>
        <li class="nav-item">
            <a href="<?php echo $link5; ?>" class="nav-link"><?php echo $name5; ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>