<?php

$textm = $_POST['textm'];
echo $textm;
$author = $_COOKIE['username'];
echo $author;
$user_id = $_COOKIE['userid'];

include "db_connection.php";

// მონაცემების ჩასაწერი სკრიპტი
$sql = "INSERT INTO posts (textm, username)
VALUES ('$textm', '$author')";
$conn->exec($sql);
$conn = null;

return header("Location: ../home.php");