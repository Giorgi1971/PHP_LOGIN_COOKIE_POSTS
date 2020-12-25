<?php 
include "header.php";

if (isset($_GET['error'])){
  echo $_GET['error'];
}
?>



<div class="forms">
  <form action="actions/signuping.php" method="POST">
    <label for="username">მომხმარებლის სახელი: </label>
    <input type="text" id="username" name="username" placeholder="მომხმარებელი . . .">

    <label for="password">მომხმარებლის პაროლი: </label>
    <input type="password" id="password" name="password" placeholder="პაროლი . . . ">
    <label for="confirm_password">გაიმეორეთ პაროლი: </label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="პაროლი . . . ">
    
    <label for="fname"> სახელი: </label>
    <input type="text" id="fname" name="fname" placeholder="სახელი . . .">

    <label for="lname"> გვარი: </label>
    <input type="text" id="lname" name="lname" placeholder="გვარი . . .">

    <input type="submit" value="რეგისტრაცია">
  </form>
</div>

<?php 
include "footer.php";
?>


