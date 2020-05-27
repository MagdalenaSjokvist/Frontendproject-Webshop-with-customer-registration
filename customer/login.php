<?php
require_once '../config/db.php';

// //initiera sessionshantering
// session_start();

//Töm variabler
// $errors = "";
// $error = array();
// $inputEmail = "";
// $storedEmail = "";
// $inputPassword = "";
// $storedPassword = "";

$errorMessage = "";
$successMessage = "";
// $errors = array();
$name = $email = $inputPassword = $storedPassword = $phone = $street = $zip = $city = "";

//Om logga in-knappen har klickats på
if (isset($_POST['submit'])) {

  //Kollar om epost eller lösnord inte är ifyllt
  if (empty($_POST['email']) || empty($_POST['password'])) {
    $errorMessage = "<div><h4>Oops! Du missade visst något? Fyll i både e-postadress och lösenord.<h4></div>";
  } else {
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];
  }

  //Testvariabler (ska bytas ut mot hämtade kunduppgifter från databasen)
  $storedEmail = "admin@mail.se";
  $storedPassword = "admin";

?>

<?php
  //Kontrollerar om de inskrivna uppgifterna matchar mot de lagrade i databasen
  //Skapar felmeddelande om något inte stämmer
  if (($inputEmail != $storedEmail) || ($inputPassword != $storedPassword)) {
    $errors[] = "Oops! Något stämmer inte. Kontrollera din epostadress och ditt lösenord igen.";
  }

  //Om det finns några fel
  if (count($errors) > 0) {
    $errorMessage = '<div class="error">';

    foreach ($errors as $e) {
      $errorMessage .= "<p> $e </p><br>";
      header('Location:index.php');
    }
    $errorMessage .= '</div>';
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
