<?php
require_once '../second_header_extern.php';
require_once '../config/db.php';
// require_once 'login.php';

//Töm variabler
// $successMessage = "";
$errorMessage = "";
$inputEmail = "";
$storedEmail = "";
$inputPassword = "";
$storedPassword = "";

//initiera sessionshantering
// session_start();


// // Check if the user is already logged in, if yes then redirect him to welcome page
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//   header("location: welcome.php");
//   exit;
// }


//Om logga in-knappen har klickats på
if (isset($_POST['submit'])) {
  $errorMessage = "";

  //Kollar om epost eller lösnord inte är ifyllt
  if (empty($_POST['email']) && empty($_POST['password'])) {
    $errorMessage = "<p class='error-message'> Fyll i e-postadress och lösenord.</p><br>";
  } else if (empty($_POST['email'])) {
    $errorMessage = "<p class='error-message'> Oops! Du missade visst något. Fyll i din e-postadress.</p><br>";
  } else if (empty($_POST['password'])) {
    $errorMessage = "<p class='error-message'>Oops! Du missade visst något. Fyll i ditt lösenord.</p><br>";
  } else {
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];
  }
}

//Testvariabler (ska bytas ut mot hämtade kunduppgifter från databasen)
// $storedEmail = "admin@mail.se";
// $storedPassword = "admin";


//Kontrollerar om de inskrivna uppgifterna matchar mot de lagrade i databasen
//Skapar felmeddelande om något inte stämmer
// if (($inputEmail != $storedEmail) || ($inputPassword != $storedPassword)) {
//   $errorMessage = "<h4>Oops! Något stämmer inte. Kontrollera din epostadress och ditt lösenord igen.</h4>";
// }

//Om det finns några fel
// if (count($errors) > 0) {
//   $errorMessage = 'något är fel';
// echo 'något är fel';
// $errorMessage = '<div class="error">';

// foreach ($errors as $e) {
//   $errorMessage .= "<p> $e </p><br>";
//   header('Location:index.php');
// }
// $errorMessage .= '</div>';
// echo $errorMessage;
// } else {
//   header('Location:welcome.php');
// }


// //Kontrollerar om felmeddelanden har skapats
// if (count($errors) == 0) {
// //Skapa en sessionsvariabel med id-nummer 1
// $_SESSION['userid'] = 1;
// header('Location: welcome.php');
// } else {
// header('Location: index.php');
// }
// }

?>

<section class="login-section">

  <form class="form-container" action="#" method="POST">
    <!-- <h1 class="login-title page-title login-container__title">Välkommen!</h1> -->
    <div class="form-container__heading">
      <h3 class="form-container__heading-text">Välkommen att logga in</h3>
    </div>

    <?php echo $errorMessage ?>
    <!-- 
          //skriv ut eventuella felmeddelanden
          // if (count($errors) > 0) {
          //   foreach ($errors as $error) {
          //     echo '<p>' . $error . '</p><br>';
          //   }
          // }
          // 
          -->

    <div class="form-container__box">
      <label for="email">E-postadress:</label><br>
      <input class="form-container__box-input" type="text" id="email" name="email">
    </div>

    <div class="form-container__box">
      <label for="password">Lösenord:</label><br>
      <input class="form-container__box-input" type="password" id="password" name="password" minlength="">

      <div class="form-container__submit">
        <input class="form-container__submit-button" type="submit" name="submit" value="Logga in">
      </div>

      <br><br>

      <div class="form-container__heading">
        <h3 class="form-container__heading-text">Ny kund hos oss?</h3>
      </div>
      <p>Välkommen att skapa ett konto via knappen nedan.</p>
      <!-- <div class="form-container__submit">
      <button id="register-button" class="form-container__submit-button" type="button"> Skapa nytt konto</button>
    </div> -->
      <div class="form-container__submit">

        <a href="register.php">
          <button type="button" class="form-container__submit-button">Skapa nytt konto</button>
        </a>
      </div>

  </form>

</section>


<?php require_once '../footer.php' ?>