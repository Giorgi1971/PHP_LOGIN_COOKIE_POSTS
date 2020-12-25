<?php 
session_start();

include "../functions.php";

if(session_ing()){
    return header("Location: ../home.php?error=Auth allowed სესიიონგი გაიარა!");
}else{
    if(isset($_GET['error'])){
        echo "session-Si შეცდომაში მიწერია ეს";
        echo '<pre>';
        print_r($_GET['error']);
        echo '</pre>';
    }
}