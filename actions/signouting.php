
<?php 
session_start();

include "../functions.php";

if (sign_out()){
    return header("Location: ../home.php?error=User $usn left page!");
}else{
    echo "what??????????";
}