<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registrazione</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Registrazione</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
	<div class="input-group">
  	  <label>Nome:</label>
  	  <input type="text" name="name" value="<?php echo $name; ?>">
  	</div>
	<div class="input-group">
  	  <label>Cognome:</label>
  	  <input type="text" name="surname" value="<?php echo $surname; ?>">
  	</div>
	<div class="input-group">
  	  <label>Codice Fiscale:</label>
  	  <input type="text" name="fcode" value="<?php echo $fcode; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email:</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password:</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Conferma password:</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Registrati</button>
  	</div>
  	<p>
  		Sei gia' membro? <a href="login.php">Accedi</a>
  	</p>
  </form>
</body>
</html>
