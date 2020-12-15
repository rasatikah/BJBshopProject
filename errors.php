<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <b><h4 style="color: red"><?php echo $error ?></h4></b>
  	<?php endforeach ?>
  </div>
<?php  endif ?>