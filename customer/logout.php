<?php
session_start();

//Töm sessionens variabler på väden
$_SESSION = array();

//Avsluta sessionen
session_destroy();

?>

<script type='text/javascript'>
  alert("Du loggas nu ut. Tack för besöket och välkommen tillbaka!")
  location.replace("login.php");
  //redirectar med JS istället för PHP (header("location:login.php")), för att alert ska hinna visas innan redirect
</script>