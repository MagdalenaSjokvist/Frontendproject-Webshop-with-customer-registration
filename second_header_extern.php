<?php

// Initierar sessionen
session_start();

require_once "config/db.php";

//Deklarera variabler för anpassade menyval (beroende på inloggad eller ej)
$menuOption3Text = "";
$menuOption3Link = "";
$menuOption4Text = "";
$menuOption4Link = "";

// Kollar om någon är inloggad och anpassar menyn därefter
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  $menuOption3Text = "MINA SIDOR";
  $menuOption3Link = "/customer/welcome.php";
  $menuOption4Text = "Logga ut";
  $menuOption4Link = "/customer/logout.php";
} else {
  $menuOption3Text = "LOGGA IN";
  $menuOption3Link = "/customer/login.php";
  $menuOption4Text = "ADMIN";
  $menuOption4Link = "/admin/index.php";
}

//Hämtar befintliga kategorier med minst en produkt från databasen för att visa i menyn 
$stmt = $db->prepare("SELECT `categoryid`, `category`
                      FROM `webshop_categories`");
$stmt->execute();

$option_value = "";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $categoryid = htmlspecialchars($row['categoryid']);
  $category = htmlspecialchars($row['category']);
  $option_value .=  "<a href='/categorypage/categorypage.php?id=" . $categoryid . "'>" . strtoupper($category) . "</a>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=
    , initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles/main.css" />
  <link rel="stylesheet" type="text/css" href="../styles/main.css" />
  <title>Spelshoppen</title>
</head>

<body>
  <header class="second_hero" id="home">

    <div class="menu-wraper">

      <div class="menu-wraper">

        <nav class="menu_nav">

          <input type="checkbox" class="hamburger">
          <label for="label_hamburger">
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
          </label>

          <div class="search-form-wrapper">
            <form id="search-form" action="" class="search-form">
              <input type="text" name="search" id="search-Field" class="search-form__input-field" placeholder="Sök efter spel">
              <button id="search_btn">Sök</button>
            </form>
            <div id="searched-result" class="search-result"></div>
          </div>

          <ul class="menu-wraper__link-list">

            <li class="menu-wraper__link-item">
              <a class="menu-wraper__links" href="/index.php">HEM</a>
            </li>
            <li class="menu-wraper__link-item">
              <div class="dropdown">
                <a class="menu-wraper__links" id="dropdown-categories" href="#">KATEGORIER</a>

                <div class="dropdown-content">
                  <?php
                  echo "$option_value";
                  ?>
                </div>
              </div>
            </li>
            <li class="menu-wraper__link-item">
              <!--Menyvalet ändrar text + länk beroende på om det finns en pågående session (någon är inloggad)-->
              <a class="menu-wraper__links" href=<?= $menuOption3Link ?>><?= $menuOption3Text ?></a>
            </li>
            <li class="menu-wraper__link-item">
              <a class="menu-wraper__links" href=<?= $menuOption4Link ?>><?= $menuOption4Text ?></a>
            </li>

          </ul>
          <div class="cart">
            <div class="cart-wrapper">
              <a class="menu-wraper__links" href="../order/orderpage.php"><img src="/images/cart.png" class="cart-img"></a>
              <span class="counter" id="counter">0</span>
            </div>
          </div>
        </nav>
      </div>

      <script type="application/javascript" src="/search/search.js"></script>