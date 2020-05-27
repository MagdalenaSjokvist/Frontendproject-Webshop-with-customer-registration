<?php
session_start();

// Töm sessionens variabler på väden
$_SESSION = array();

//Avsluta sessionen
session_destroy();

header("location:index.php");
exit;
