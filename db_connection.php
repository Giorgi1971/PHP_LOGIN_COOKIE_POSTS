<?php
$servername = "localhost";
$adminname = "root";
$password = "";
$dbname = "gio_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $adminname, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
}
?>