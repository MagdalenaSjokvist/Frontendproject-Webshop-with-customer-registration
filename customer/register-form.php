<?php
require_once '../second_header_extern.php';
require_once '../config/db.php';

?>

<section class="register-section">


  <form class="form-container" action="register.php" method="POST">

    <div class="form-container__heading">
      <h3 class="form-container__heading-text">Skapa nytt konto</h3>
    </div><br>

    <div class="form-container__box">
      <label for="name">För- och efternamn:</label><br>
      <input type="text" name="name" id="name" onblur="validateName()" class="form-container__box-input" required>
      <br>
      <span class="nameValidationText"></span>
    </div>

    <div class="form-container__box">
      <label for="email">E-post:</label><br>
      <input type="text" name="email" id="email" onblur="validateEmail()" class="form-container__box-input" placeholder="exempel@test.com" required>
      <br>
      <span class="emailValidationText"></span>
    </div>

    <div class="form-container__box">
      <label for="password">Lösenord:</label><br>
      <input type="text" name="password" id="password" onblur="validatePassword()" class="form-container__box-input" required>
      <br>
      <span class="emailValidationText"></span>
    </div>

    <div class="form-container__box">
      <label for="phone">Mobilnummer:</label><br>
      <input type="text" name="phone" id="phone" onblur="validatePhone()" class="form-container__box-input" placeholder="(ex. 0701234567)" required>
      <br>
      <span class="phoneValidationText"></span>
    </div>

    <div class="form-container__box">
      <label for="street">Gatuadress:</label><br>
      <input type="text" name="street" id="street" onblur="validateStreet() " class="form-container__box-input" required>
      <br>
      <span class="streetValidationText"></span>
    </div>

    <div class="form-container__box">
      <label for="zip">Postnr:</label><br>
      <input type="text" name="zip" id="zip" oninput="validateZipcode()" placeholder="(ex. 123 45)" class="form-container__box-input" required>
      <br>
      <span class="zipcodeValidationText"></span>
    </div>

    <div class="form-container__box">
      <label for="city">Ort:</label><br>
      <input type="text" name="city" id="city" onblur="validateCity()" class="form-container__box-input" required>
      <br>
      <span class="cityValidationText"></span>
    </div>

    <div class="form-container__submit">
      <input type="submit" value="Skapa konto" class="form-container__submit-button">
    </div>
</section>

<?php require_once '../footer.php' ?>