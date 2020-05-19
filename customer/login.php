<?php
require_once '../second_header_extern.php';
require_once '../config/db.php';

?>

<div class="login-container">
  <form action="POST">
    <div>
      <label for="email">E-postadress:</label>
      <input type="text" id="email" name="email" required>
    </div>

    <div>
      <label for="password">Lösenord (8 characters minimum):</label>
      <input type="password" id="password" name="password" minlength="" required>
    </div>

    <input type="submit" value="Sign in">
  </form>
</div>