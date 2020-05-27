<?php
require_once '../config/db.php';


//initiera sessionshantering
session_start();

// kollar om användaren redan är inloggad som då skickas till välkomstsidan
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: welcome.php");
  exit;
}

$errorText = "";
$errors = array();
$name = $email = $password = $phone = $street = $zip = $city = "";

//Om logga in-knappen har klickats på
if (isset($_POST['submit'])) {

  //Kollar om epost eller lösnord inte är ifyllt
  if (empty($_POST['email']) || empty($_POST['password'])) {
    $errors[] = "Oops! Du missade visst något? Fyll i både e-postadress och lösenord.";
  } else {
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];
  }

  //Testvariabler (ska bytas ut mot hämtade kunduppgifter från databasen)
  $storedEmail = "admin@mail.se";
  $storedPassword = "admin";

  //Kontrollerar om de inskrivna uppgifterna matchar mot de lagrade i databasen
  //Skapar felmeddelande om något inte stämmer
  if (($inputEmail != $storedEmail) || ($inputPassword != $storedPassword)) {
    $errors[] = "Oops! Något stämmer inte. Kontrollera din epostadress och ditt lösenord igen.";
  }

  //Om det finns några fel
  if (count($errors) > 0) {

    foreach ($errors as $e) {
      $errorText .= "<div class='error'><p> $e </p></div><br />";
      header('Location:index.php');
    }
  } else {
    header('Location:welcome.php');
  }
}
//   //Kontrollerar om felmeddelanden har skapats
//   if (count($errors) == 0) {
//     //Skapa en sessionsvariabel med id-nummer 1
//     $_SESSION['userid'] = 1;
//     header('Location: welcome.php');
//   } else {
//     header('Location: index.php');
//   }
// }
