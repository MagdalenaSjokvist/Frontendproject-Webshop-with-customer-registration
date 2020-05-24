<?php
require_once '../second_header_extern.php';
require_once '../config/db.php';

?>

<section class="login-container">

  <h1 class="login-title page-title login-container__title">Välkommen!</h1>

  <form class="login-form" action="#" method="POST">
    <h2>Logga in</h2>

    <div class="login-form__email form-container__box">
      <label for="email">E-postadress:</label>
      <input type="text" id="email" name="email" required>
    </div>

    <div class="login-form__password form-container__box">
      <label for="password">Lösenord (minst 2 tecken):</label>
      <input type="password" id="password" name="password" minlength="" required>
    </div>

    <input type="submit" value="Logga in">
  </form>

</section>

<section class="register-container">
  <h2>Registrera dig</h2>
</section>

<?php require_once '../footer.php' ?>