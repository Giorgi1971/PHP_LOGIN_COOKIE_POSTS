<?php 

// შექმენით ავტორიზაციისა და რეგისტრაციის ფუნქციები
// ფუნქცია sign up-დან POST-ით მოსული მოცემული მონაცემების მიღება და შემოწმება.

function sign_up(){
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['fname']) && isset($_POST['lname'])){
        $username = $_POST['username'];
        $psw = $_POST['password'];
        $psw2 = $_POST['confirm_password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        if (strlen($username) >= 3 && strlen($psw) >= 3 && strlen($psw2) >= 3 && strlen($fname) >= 0 && strlen($lname) >= 0){
            if ($psw2 == $psw){
            // მომხმარებლის ნიკის წაკითხვა მონაცემების ბაზიდან
                include "db_connection.php";
                $stmt = $conn->prepare("SELECT username FROM users WHERE username='$username'");
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                $users = $stmt->fetchAll();
                if (!$users){
                    
                # რეგისტრირებული მომხმარებელის მონაცემების SQL-ში ჩაწერა.
                    $pswhash = password_hash($psw, PASSWORD_BCRYPT);
                    $sql = "INSERT INTO users (username, userpassword, fname, lname)
                    VALUES ('$username', '$pswhash', '$fname', '$lname')"; // , '$session_key'
                    $conn->exec($sql);
                    $conn = null;
                    return true;
                }else{
                    $conn = null;
                    return header("Location: ../signup.php?error=Username already taken, try another!");
                }                    
            }else{
                return header("Location: ../signup.php?error=Passwords does not match!");
            }
        }else{
            return header("Location: ../signup.php?error=Fill out Forms! Username and password at least 3 symblos!");
        }
    }else{
        return header("Location: ../signup.php?error=Forms are are are not correct!");
    }
} 

# Sign-In ფორმიდან მონაცემების მიღება და დამუშავება.

function sign_in(){
    if (!isset($_POST['username']) && !isset($_POST['password']) && !isset($_POST['device'])){
        return header("Location: ../signin.php?error=Forms are not correct!");
    }

    $username = $_POST['username'];
    $psw = $_POST['password'];
    $device = $_POST['device'];
    
    if (strlen($username) < 3 && strlen($psw) < 3 && strlen($device) < 3){
        return header("Location: ../signin.php?error=Fill out Forms, each at least 3 symblos!");
    }

    // ვიღებთ მონაცემებს ბაზიდან ავტორიზაციისათვის შესადარებლად.
    include "db_connection.php";
    $stmt = $conn->prepare("SELECT id, username, userpassword FROM users WHERE username='$username'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $users = $stmt->fetchAll();

    echo "ნაპოვნია ",count($users)," მომხმარებელი <br>";
    if(count($users) !== 1){
        return header("Location: ../signin.php?error=Something Wrong, ask Administrator!");
    }
    $user = $users[0];
    $userid = $user['id'];
    
    if (!password_verify($_POST['password'], $user['userpassword'])){
        return header("Location: ../signin.php?error=Username or Password are not correct!");
    }
    
    echo "მომხმარებელმა",$user['username']," წარმატებით გაიარა ავტორიზაცია";

    // ცხრილი 2-დან ვშლით მანამდე ავტორიზებულ მომხმარებელს

    $sql = "DELETE FROM users_reg WHERE device='$device'";
    $conn->exec($sql);
    $session_key = md5($device.time()); //ვაკეთებთ სესსის კოდს
        
    // შეგვაქვს მონაცემები მეორე ცხრილში
    $sql = "INSERT INTO users_reg (_id, username, device, session_verify, auth)
    VALUES ('$userid', '$username', '$device', '$session_key', '1')";
    $conn->exec($sql);

    # რეგისტრირებული მომხმარებელზე სესიების შექმნა.
    
    if(!$_SESSION['devices']){
        $_SESSION['devices']= [];
    } 
    $_SESSION["devices"][$device]=[
        "username" => $username,
        "user_id" => $userid,
        "device" => $device,
        "session_key" => $session_key,
        "auth" => '1'
    ];
    setcookie("username",$username, time()+ 86400 * 30, '/');
    setcookie("user_id",$user_id, time()+ 86400 * 30, '/');
    setcookie("device",$device, time() + 86400 * 30, '/');
    setcookie("session_key",$session_key, time() + 86400 * 30, '/');

    $conn = null;
    return true;
    }

// index გვერდიდან შესვა, გვაქვს მომხმარებლის და მოწყობილობს სახელი:
function session_ing(){
    if(!isset($_POST['username']) || !isset($_POST['device'])){
        return header("Location: ../index.php?error=ფორმები არასწორია!");
    }
    
    if(strlen($_POST['device']) < 1){
        return header("Location: ../index.php?error=კომპიუტერის სახელი უნდა ჩაიწეროს");
    }
    $dvc = $_POST['device'];
    
    if ($dvc == $_COOKIE['device']){
        return true;
    }


    // თუ სესიებს დივაისი არ აქვს, ესე იგი ავტორიზებული არაა არცერთი კომპიუტერი
    if (!isset($_SESSION['devices'])){
        return header("Location: ../home.php?error=სესიებში რეგისტრირებული მოწყობილობა არაა, 0-ია");
    }
    
    // თუ დივაისი სესიების დივაისში არაა, ესეიგი ავტორიზებული არ ყოფილა ეს კომპიუეტრი
    if (!array_key_exists($dvc, $_SESSION['devices'])){
        setcookie("username", "", time() - 3600, '/');
        setcookie("user_id", "", time() - 3600, '/');
        setcookie("device", "", time() - 3600, '/');
        setcookie("session_key", "", time() - 3600, '/');
        return header("Location: ../home.php?error= კონკრეტულად მითითებული მოწყობილობა ავტორიზებული არ ყოფილა!");
    }
    
    // ვნახულობთ ამ კოპზე ბაზაში თუა ავტორიზაცია და ვადარებთ სესიისას
    include "db_connection.php";
    $stmt = $conn->prepare("SELECT _id, username, session_verify FROM users_reg WHERE device='$dvc'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $users = $stmt->fetchAll();
    $conn = null;

    if (count($users) !== 1){
        return header("Location: ../signin.php?error=შეატყობინეთ ადმინისტრატორს!");
    }

    $user = $users[0];
    $sess = $_SESSION['devices'][$dvc];

    if($user['session_verify'] == $sess['session_key'] && $user['username'] == $sess['username']){
        setcookie("username",$user['username'], time()+ 86400 * 30, '/');
        setcookie("user_id",$user['username'], time()+ 86400 * 30, '/');
        setcookie("device",$dvc, time() + 86400 * 30, '/');
        setcookie("session_key",$user['session_verify'], time() + 86400 * 30, '/');
        return true;
    }
}

function delete($del, $delcolumn, $deltable){
    include "db_connection.php";
    $sql = "DELETE FROM $deltable WHERE $delcolumn='$del'";
    $conn->exec($sql);
    $conn = null;

}


function sign_out(){
    $dvc = $_COOKIE['device'];
    unset($_SESSION['devices'][$dvc]);


    // მონაცმების წაშლა ცხრილი 2 -დან

    delete($dvc, 'device', 'users_reg');

    setcookie("username", "", time() - 3600, '/');
    setcookie("user_id", "", time() - 3600, '/');
    setcookie("device", "", time() - 3600, '/');
    setcookie("session_key", "", time() - 3600, '/');
    // setcookie("gadget", "", time() - 3600, '/');
    return true;
}

?>