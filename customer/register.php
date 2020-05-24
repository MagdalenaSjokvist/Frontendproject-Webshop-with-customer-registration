<?php
require_once "../config/db.php";

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

    if (strlen($name) < 2) {
      $error[] =  "Ditt namn måste innehålla minst två tecken";
    }
    //if (preg_match('/\s/',$name) > 0)  {
    if (strpos($name, " ") < 1) {
      $error[] =  "Ditt namn måste innehålla minst ett mellanslag";
    }

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

    //Skicka beställning till databasen
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
      header('Location:register-form.php');
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
