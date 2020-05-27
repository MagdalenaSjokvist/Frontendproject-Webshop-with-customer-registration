<?php
require_once '../second_header_extern.php';
// require_once '../config/db.php';

// // Initialize the session
// session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: welcome.php");
  exit;
}


// require_once 'login.php';
//Töm variabler
$errorMessage = "";
$customerId = "";
$customerName = "";
$inputEmail = "";
$storedEmail = "";
$inputPassword = "";
$storedPassword = "";


//Om logga in-knappen har klickats på
if (isset($_POST['submit'])) {
  $errorMessage = "";

  //Kollar om epost eller lösnord är ifyllt och visar felmeddelanden om något saknas
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


  //Hämtar id, e-postadress och lösenord från databasen
  $sql = "SELECT customerid, name, email, password FROM webshop_customers WHERE email=:email";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':email', $inputEmail);
  $stmt->execute();

  //Kollar om e-postadressen finns i databasen 
  if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      //Hämta uppgifterna från den aktuella kundraden, och spara i variabler
      $customerId = ($row['customerid']);
      $customerName = ($row['name']);
      $storedEmail = ($row['email']);
      $storedPassword = ($row['password']);
      if (password_verify($inputPassword, $storedPassword)) {

        // Lösenordet stämmer - starta en ny session
        session_start();

        //Spara data i sessions-variabler
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $customerId;
        $_SESSION["username"] = $customerName;

        // Redirect user to welcome page
        // header("location: welcome.php");
      } else {
        // Display an error message if password is not valid
        $errorMessage = "<p class='error-message'>Ditt lösenord stämmer inte, prova igen!</p>";
      }
    }

    //Om e-postadressen inte finns registrerad i databasen
  } else {
    $errorMessage = "<p class='error-message'>Din e-postadress verkar inte vara registrerad. Prova igen eller skapa ett nytt konto.</p>
  </a>";
  }
}



?>

<section class="login-section">
  <?php print_r($_SESSION) ?>
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