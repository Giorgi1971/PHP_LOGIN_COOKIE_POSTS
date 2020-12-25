<?php 
session_start();

include "../functions.php";

if (sign_up()){
    return header("Location: ../signin.php?error=User ".$_SESSION['username']." registered succesfully!");
}else{
    return "What? What? What?";
}

?>