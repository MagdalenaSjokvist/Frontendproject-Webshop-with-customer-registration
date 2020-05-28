<?php
require_once '../second_header_extern.php';

?>

<section class="welcome-section">

  <h1>Välkommen <?php echo $_SESSION["name"] ?>!</h1>
  <br>
  <p>
    <a href='../index.php'><button type='button' class='form-container__submit-button'>Börja shoppa!</button>
      <br><br><a href='reset-password.php'><button type='button' class='form-container__submit-button'>Återställ lösenord</button>
      </a>
    </a>
  </p>
</section>

<?php require_once '../footer.php' ?>