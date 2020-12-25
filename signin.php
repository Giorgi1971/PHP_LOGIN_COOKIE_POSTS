
<?php 
include "header.php";

if (isset($_GET['error'])){
  echo $_GET['error'];
}
?>


<div class="forms">
  <form action="actions/signining.php" method="POST">
    <label for="username">მომხმარებლის სახელი:</label>
    <input type="text" id="username" name="username" placeholder="მომხმარებელი . . .">

    <label for="password">მომხმარებლის პაროლი:</label>
    <input type="password" id="password" name="password" placeholder="პაროლი . . . ">

    <label for="device">მოწყობილობა:</label>
    <input type="text" id="device" name="device" placeholder="მოწყობილობის  . . . ">
 
    <input type="submit" value="შესვლა">
  </form>
</div>

<?php 
include "footer.php";
?>