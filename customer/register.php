<?php
require_once '../second_header_extern.php';
require_once '../config/db.php';


$message = "";
$errors = array();
$name = $email = $password = $encryptedPassword = $phone = $street = $zip = $city = "";

//Lyssnar efter POST-request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  //Kontrollerar för varje fält om det är ifyllt eller tomt
  if (empty($_POST['name'])) {
    $errors[] = "Du måste ange ditt namn";
  } else if (isset($_POST['name'])) {
    $name = test_input($_POST['name']);
  }

  if (empty($_POST['email'])) {
    $errors[] = "Du måste ange en e-postadress";
  } else if (isset($_POST['email'])) {

    //Kontrollerar om e-postadressen redan är registrerad (finns i databasen)
    $sql_c = "SELECT * FROM webshop_customers WHERE email = :email";
    $stmt_c = $db->prepare($sql_c);
    $stmt_c->bindParam(':email', $email);
    $stmt_c->execute();

    if ($stmt_c->rowCount() > 0) {
      $errors[] = "E-postadressen  " . $email . " finns redan registrerad";
    } else {
      $email = test_input($_POST['email']);
    }
  }

  if (empty($_POST['password'])) {
    $errors[] = "Du måste ange ett lösenord";
  } else if (isset($_POST['password'])) {
    $password = test_input($_POST['password']);
    //skapar ett krypterat lösenord (för säkerhetsoptimering)
    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
  }


  if (empty($_POST['phone'])) {
    $errors[] = "Du måste ange telefonnummer";
  } else if (isset($_POST['phone'])) {
    $phone = test_input($_POST['phone']);
  }

  if (empty($_POST['street'])) {
    $errors[] = "Du måste ange gatuadress";
  } else if (isset($_POST['street'])) {
    $street = test_input($_POST['street']);
  }

  if (empty($_POST['zip'])) {
    $errors[] =  "Du måste ange gatuadress";
  } else if (isset($_POST['zip'])) {
    $zip = test_input(str_replace(' ', '', $_POST['zip']));
  }

  if (empty($_POST['city'])) {
    $errors[] = "Du måste ange gatuadress";
  } else if (isset($_POST['city'])) {
    $city = test_input($_POST['city']);
  }


  //Om det inte finns några felmeddelanden
  if (count($errors) == 0) {

    //Skicka kundupopgifterna till databasen
    $sql = "INSERT INTO webshop_customers (name, email, password, phone, street, zip, city)
            VALUES (:name, :email, :password, :phone, :street, :zip, :city)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $encryptedPassword);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':zip', $zip);
    $stmt->bindParam(':city', $city);
    $stmt->execute();

    $message = "<div><h4> Tack för din registrering! Nu kan du logga in med dina uppgifter.</h4><br>        
          <a href='login.php'><button type='button' class='form-container__submit-button'>Logga in</button>
  </a></div><br>";
  }

  //Om det finns några fel
  if (count($errors) > 0) {

    foreach ($errors as $e) {
      $message .= "<div class='errors'><p> $e </p></div><br />";
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

<section class="register-section">

  <form class="form-container" action="#" method="POST">
    <?php echo $message ?>

    <div class="form-container__heading">

      <h3 class="form-container__heading-text">Skapa nytt konto</h3>
    </div><br>

    <div class="form-container__box">
      <label for="name">För- och efternamn:</label><br>
      <input type="text" name="name" id="name" onblur="validateName()" class="form-container__box-input" required>
      <br>
      <p class="nameValidationText"></p>
    </div>

    <div class="form-container__box">
      <label for="email">E-post:</label><br>
      <input type="text" name="email" id="email" onblur="validateEmail()" class="form-container__box-input" placeholder="exempel@test.com" required>
      <br>
      <p class="emailValidationText"></p>
    </div>

    <div class="form-container__box">
      <label for="password">Lösenord:</label><br>
      <input type="text" name="password" id="password" oninput="validatePassword()" class=" form-container__box-input" required>
      <br>
      <p class="passwordValidationText"></p>
      <div class="password-strength-meter" id="password-strength-meter"></div>
      <div class="password-weaknesses" id="password-weaknesses"></div>
    </div>

    <div class="form-container__box">
      <label for="phone">Telefonnummer:</label><br>
      <input type="text" name="phone" id="phone" onblur="validatePhone()" class="form-container__box-input" required>
      <br>
      <span class="phoneValidationText"></span>
    </div>

    <div class="form-container__box">
      <label for="street">Gatuadress:</label><br>
      <input type="text" name="street" id="street" onblur="validateStreet() " class="form-container__box-input" required>
      <br>
      <p class="streetValidationText"></p>
    </div>

    <div class="form-container__box">
      <label for="zip">Postnr:</label><br>
      <input type="text" name="zip" id="zip" oninput="validateZipcode()" placeholder="(ex. 123 45)" class="form-container__box-input" required>
      <br>
      <p class="zipcodeValidationText"></p>
    </div>

    <div class="form-container__box">
      <label for="city">Ort:</label><br>
      <input type="text" name="city" id="city" onblur="validateCity()" class="form-container__box-input" required>
      <br>
      <p class="cityValidationText"></p>
    </div>

    <div class="form-container__submit">
      <input type="submit" name="submit" value="Skapa konto" id="submit-registration-btn" class="form-container__submit-button">
    </div>
  </form>
</section>

<?php require_once '../footer.php' ?>