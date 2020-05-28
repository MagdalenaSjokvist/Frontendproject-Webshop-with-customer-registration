<?php
require_once '../second_header_extern.php';
require_once '../config/db.php';

$message = "";
$errors = array();
$newPassword = "";
$confirmedPassword = "";
$newEncryptedPassword = "";


//Lyssnar efter klick på "Spara lösenord-knappen" (POST-request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  //Kollar att alla fält är korrekt ifyllda
  if (empty($_POST['password'])) {
    $errors[] = "<p class='error-message'>Du måste ange ett nytt lösenord</p>";
  } else if (isset($_POST['password'])) {
    $newPassword = test_input($_POST['password']);
  }

  if (empty($_POST['confirm-password'])) {
    $errors[] = "<p class='error-message'>Du måste upprepa ditt nya lösenord</p>";
  } else if (isset($_POST['confirm-password'])) {
    $confirmedPassword = test_input($_POST['confirm-password']);
  }

  //Kontrollerar att båda lösenorden matchar
  if ($newPassword == $confirmedPassword) {
    //Om allt är OK - skapa ett krypterat lösenord som kan skickas till databasen
    $newEncryptedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  } else {
    $errors[] = "<p class='error-message'>Lösenorden matchar inte. Kontrollera att du skrivit samma två gånger.</p>";
  }


  //Om det inte finns några felmeddelanden
  if (count($errors) == 0) {

    //Uppdatera databasen med nya lösenordet
    $sql = "UPDATE webshop_customers SET password = :password WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $_SESSION["email"]);
    $stmt->bindParam(':password', $newEncryptedPassword);
    $stmt->execute();

    $message = "<p class='error-message'>Ditt lösenord har uppdaterats!</p>";
  } else {
    foreach ($errors as $e) {
      $message .= "<div class='errors'><p> $e </p></div>";
    }
  }
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<section class="welcome-section">

  <form class="form-container" action="#" method="POST">

    <div class="form-container__heading">

      <h3 class="form-container__heading-text">Återställ ditt lösenord</h3>
    </div><br>
    <?php echo $message ?>

    <div class="form-container__box">
      <label for="password">Nytt lösenord:</label><br>
      <input type="text" name="password" id="password" oninput="validatePassword()" class=" form-container__box-input" required>
      <br>
      <p class="passwordValidationText"></p>
      <div class="password-strength-meter" id="password-strength-meter"></div>
      <div class="password-weaknesses" id="password-weaknesses"></div>
    </div>

    <div class="form-container__box">
      <label for="confirm-password">Upprepa nytt lösenord:</label><br>
      <input type="text" name="confirm-password" id="confirm-password" class=" form-container__box-input" required>
      <br>

      <div class="form-container__submit">
        <input type="submit" name="submit" value="Spara nytt lösenord" id="submit-registration-btn" class="form-container__submit-button">
      </div>

  </form>

</section>

<?php require_once '../footer.php' ?>