<?php 
session_start();

$auth = false;

if (isset($_COOKIE)){
    if (isset($_COOKIE['device'])){
        $dvc = $_COOKIE['device'];
        include "db_connection.php";
        // ცხრილ 2-ში დასტურდება თუ არა ამ კომპის ავტორიზაცია.
        $stmt = $conn->prepare("SELECT id, session_verify, device FROM users_reg WHERE device='$dvc'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $users = $stmt->fetchAll();
        $conn = null;
        if (count($users) == 1){
            $user = $users[0];
            if($user["session_verify"] == $_COOKIE['session_key']){
            $auth = true;
            }
        }
    }
}    


$navList =array(
    array("id"=> 1, "name" =>"Home", "link"=>"home.php"),
    array("id"=> 2, "name" =>"News", "link"=>"news.php"),
    array("id"=> 3, "name" =>"Contact", "link"=>"contact.php"),
    array("id"=> 4, "name" =>"About", "link"=>"about.php")
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<ul>
    <?php 
    foreach ($navList as $key => $value) {?>
    <li><a href="<?php echo $value['link']; ?>"><?php echo $value['name']; ?></a></li>
<?php
}

if ($auth){?>
    <li style="float:right"><a  href="actions/signouting.php">Sign Out</a></li>
    <?php
}else{?>
    <li style="float:right"><a  href="signup.php">Sign Up</a></li>
    <li style="float:right"><a  href="signin.php">Log In</a></li>
<?php
}
?>
</ul>
<hr>
<h3 style="color: darkred;">
<?php
if ($auth){
    $usr = $_COOKIE['username'];
    echo "ავტორიზებული მომხმარებელია - ", $usr, "!";
}else{
    echo "გვერდი არა ავტორიზებული მომხმარებლებისთვის!";
}
?>
</h3>

