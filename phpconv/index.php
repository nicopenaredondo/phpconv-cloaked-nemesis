<?php require_once 'functions.php';?>
<html> 
<body>
	<?php if(isset($_POST['submit'])):?>
	<?php
		read_file(upload_file());
		
		?>
	<?php else:?>
	
  <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
	<input name="uploaded_file" type="file" />
    <br>
    <input type="submit" value="Upload"  name="submit" />
  </form> 
  <?php endif;?>
</body> 
</html>