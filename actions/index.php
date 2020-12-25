<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "db_connection.php";?>
<?php 


// მონაცემების ჩასაწერი სკრიპტი
    // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    // VALUES ('John', 'Doe', 'john@example.com')";
    // $conn->exec($sql);


// მონაცემების წასაკითხი სკრიპტი
    // $stmt = $conn->prepare("SELECT id, username, created_at FROM users");
    // $stmt->execute();
    // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // $users = $stmt->fetchAll();


    // foreach($users as $user){
    //     echo $user["id"],$user["username"],$user["created_at"],"<br>";
    // }


// მონაცმების გასაახლებელი სკრიპტი
    // $sql = "UPDATE users SET username='John' WHERE id=6";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();


// მონაცმების წასაშლელი სკრიპტი
    // $sql = "DELETE FROM users WHERE id=7";
    // $conn->exec($sql);


$conn = null;
?>



</body>
</html>