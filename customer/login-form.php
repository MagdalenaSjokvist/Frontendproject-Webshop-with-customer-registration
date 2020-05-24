<?php
require_once '../second_header_extern.php';
require_once '../config/db.php';

?>

<section class="login-section">

  <form class="form-container" action="login.php" method="POST">
    <!-- <h1 class="login-title page-title login-container__title">Välkommen!</h1> -->
    <div class="form-container__heading">
      <h3 class="form-container__heading-text">Logga in</h3>
    </div><br>

    <div class="form-container__box">
      <label for="email">E-postadress:</label><br>
      <input class="form-container__box-input" type="text" id="email" name="email" required>
    </div>

    <div class="form-container__box">
      <label for="password">Lösenord:</label><br>
      <input class="form-container__box-input" type="password" id="password" name="password" minlength="" required>
    </div>

    <div class="form-container__submit">
      <input class="form-container__submit-button" type="submit" value="Logga in">
    </div>

    <br><br>


    <h1>Ny kund hos oss?</h1>
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