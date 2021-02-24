<?php
session_start();

// inizializzazione variabili
$email    = "";
$name     = "";
$surname  = "";
$fcode    = "";
$errors = array(); 

// connessione al database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// Registrazione utente
if (isset($_POST['reg_user'])) {
  // ricevo tutte le variabili da input
  $name =  mysqli_real_escape_string($db, $_POST['name']);
  $surname =  mysqli_real_escape_string($db, $_POST['surname']);
  $fcode =  mysqli_real_escape_string($db, $_POST['fcode']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // Controllo correttezza dati inseriti nel form
  if (empty($fcode)) { array_push($errors, "Codice Fiscale richiesto!"); }
  if (empty($name)) { array_push($errors, "Nome Richiesto"); }
  if (empty($surname)) { array_push($errors, "Cognome richiesto!"); }
  if (empty($email)) { array_push($errors, "Email richiesta!"); }
  if (empty($password_1)) { array_push($errors, "Password richiesta!"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Le password non corrispondono");
  }

  // controllo se utente esiste già per email e/o codice fiscale
  $user_check_query = "SELECT * FROM users WHERE fcode='$fcode' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // se il codice fiscale esiste
    if ($user['fcode'] === $fcode) {
      array_push($errors, "Codice Fiscale già registrato");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email già registrata");
    }
  }

  // Registro utente se non sono stati riscontrati errori
  if (count($errors) == 0) {
  	$password = md5($password_1); 

  	$query = "INSERT INTO users (nome, surname, fcode, email, password) VALUES('$name', '$surname', '$fcode' '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "Adesso sei loggato";
  	header('location: index.php');
    
  }
}
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($email)) {
        array_push($errors, "Email richiesta");
    }
    if (empty($password)) {
        array_push($errors, "Password richiesta");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['email'] = $email;
          $_SESSION['success'] = "Adesso sei loggato";
          header('location: index.php');
        }else {
            array_push($errors, "Combinazione email/password errata");
        }
    }
  }
  
  ?>