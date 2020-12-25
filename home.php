<?php 

include "header.php";

echo "<h2>Home!</h2>";

echo "<hr>";
if(isset($_SESSION)){
  foreach ($_SESSION as $key => $value) {
    echo '<pre>';
    print_r($value);
    echo '<pre>';  
  }
}
echo '<hr>';
echo "ქუქიები თუ არის:";
if(isset($_COOKIE)){
  foreach ($_COOKIE as $key => $value) {
    echo '<pre>';
    echo $key, " - ", $value;
    echo '<pre>';  

  }
}

echo '<hr>';
if (isset($_GET['error'])){
  echo "<hr>";
  echo "<hr>";
  echo $_GET['error'];
  }
echo '<hr>';

include "footer.php";
