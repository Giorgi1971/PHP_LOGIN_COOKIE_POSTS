<?php 
session_start();

include "../functions.php";

if (sign_in()){
    return header("Location: ../home.php?error=Auth allowed!");
}else{
    return header("Location: ../signin.php?error= ეს ჩანაწერი მოდის sign-in-ing-ის false-დან!");
}