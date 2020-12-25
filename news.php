<?php 

include "header.php";

// მონაცემების წასაკითხი სკრიპტი

include "db_connection.php";

$stmt = $conn->prepare("SELECT username, textm, register_date FROM posts");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

$users = $stmt->fetchAll();
$users = array_reverse($users);
foreach($users as $user){
  echo '<hr>';
  $author = $user['username'];
  $textm = $user['textm'];
  $rdate = ($user['register_date']);
  echo "<p> $textm <br> <b>ავტორი: $author. თარიღი: $rdate </b></p>";
}


$news = array(
  array("id"=>1, "title"=>"News-1","content"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium animi hic ea asperiores. Natus ipsa repellat eaque velit vero quo beatae dicta tenetur, exercitationem, ipsam, excepturi illo perferendis eum commodi!"),
  array("id"=>2, "title"=>"News-2","content"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium animi hic ea asperiores. Natus ipsa repellat eaque velit vero quo beatae dicta tenetur, exercitationem, ipsam, excepturi illo perferendis eum commodi!"),
  array("id"=>3, "title"=>"News-3","content"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium animi hic ea asperiores. Natus ipsa repellat eaque velit vero quo beatae dicta tenetur, exercitationem, ipsam, excepturi illo perferendis eum commodi!")
);

?>

<div class="card">
<?php
  foreach ($news as $key => $value) {?>
    <h1><?php echo $value['title']; ?></h1>
    <p><?php echo $value['content']; ?></p>
    <p><button>Read More</button></p>
    <?php
  }
  ?>
    </div>
<?php
include "footer.php";