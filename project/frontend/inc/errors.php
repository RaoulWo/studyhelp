<?php
if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo '<span style="color:red;text-align:center;">' . $error . '</span>';  ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>