<?php
require_once '../second_header_extern.php';
require_once '../config/db.php';
require_once 'login.php';


$errors = "";
$error = array();
$name = $email = $password = $phone = $street = $zip = $city = "";

//Lyssnar efter POST-request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  //Kontrollerar för varje fält om det är ifyllt eller tomt

  if (empty($_POST['name'])) {
    $error[] =  "Du måste ange ditt namn";
  } else if (isset($_POST['name'])) {
    $name = $_POST['name'];

    // //if (preg_match('/\s/',$name) > 0)  {
    // if (strpos($name, " ") < 1) {
    //   $error[] =  "Ditt namn måste innehålla minst ett mellanslag";
    // }

    if (preg_match("/^[a-öA-Ö\s]*$/", $name)) {
      $name = test_input($_POST['name']);
    } else {
      $error[] = "Namnet får endast innehålla bokstäver och mellanslag";
    }
  }


  if (empty($_POST['email'])) {
    $error[] =  "Du måste ange namn";
  } else if (isset($_POST['email'])) {
    $email = $_POST['email'];
  }


  if (empty($_POST['password'])) {
    $error[] =  "Du måste ange ett lösenord";
  } else if (isset($_POST['password'])) {
    $password = $_POST['password'];
    //skapar ett hashed password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  }

  //   if (preg_match("/^[a-öA-Ö\s]*$/", $password)) {
  //     $password = test_input($_POST['password']);
  //   } else {
  //     $error[] = "Lösenordet får endast innehålla bokstäver och mellanslag";
  //   }
  // }

  if (empty($_POST['phone'])) {
    $error[] =  "Du måste ange telefonnummer";
  } else if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
  }

  if (empty($_POST['street'])) {
    $error[] =  "Du måste ange gatuadress";
  } else if (isset($_POST['street'])) {
    $street = $_POST['street'];
  }

  if (empty($_POST['zip'])) {
    $error[] =  "Du måste ange gatuadress";
  } else if (isset($_POST['zip'])) {
    $zip = str_replace(' ', '', $_POST['zip']);
  }

  if (empty($_POST['city'])) {
    $error[] =  "Du måste ange gatuadress";
  } else if (isset($_POST['city'])) {
    $city = $_POST['city'];
  }


  //Om det inte finns några felmeddelanden
  if (count($error) == 0) {

    //Skicka kundupopgifterna till databasen
    $sql = "INSERT INTO webshop_customers (name, email, password, phone, street, zip, city)
            VALUES (:name, :email, :password, :phone, :street, :zip, :city)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':zip', $zip);
    $stmt->bindParam(':city', $city);
    $stmt->execute();
  }

  //Om det finns några fel
  if (count($error) > 0) {

    foreach ($error as $e) {
      $errors .= "<div class='error'><p> $e </p></div><br />";
      header('Location:register.php');
    }
  } else {
    header('Location:login-form.php');
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
</section>

<?php require_once '../footer.php' ?>