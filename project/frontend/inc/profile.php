<?php
$db = mysqli_connect('localhost', 'root', '', 'user');
$username = $_SESSION['benutzer']['username'];
$pts = "SELECT punkte FROM user WHERE username='$username'";
$points = mysqli_fetch_assoc(mysqli_query($db, $pts));
$lvl = "SELECT level FROM user WHERE username='$username'";
$lvls = mysqli_fetch_assoc(mysqli_query($db, $lvl));
$img = "SELECT bild FROM user WHERE username='$username'";
$img1 = mysqli_fetch_assoc(mysqli_query($db, $img));
$imgURL = 'inc/bilder/'.$img1["bild"];
?>




<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <img src="<?php echo $imgURL; ?>"  class="rounded" width=75 height =75 alt="Profilbild">
        <h2 class="modal-title"><?php echo $_SESSION['benutzer']['username'];?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body fs-3">
        <div class="row col-12">
          <div class="col-lg text-center">
              <span class="fw-bold text-success">
                Level <?php echo $lvls['level'];?>  
              </span>
          </div>
          <div class="col-lg text-center">
            <span class="fw-bold text-success"> 
              Punkte <?php echo $points['punkte'];?>
            </span>
          </div>
        </div>
        <br>
        Levelfortschritt: <progress max="1000" value="<?php echo $points; ?>"></progress>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
