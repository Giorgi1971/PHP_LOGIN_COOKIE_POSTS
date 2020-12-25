<!-- საიტი: რეგისტრაცია, შესვლა და 4 გვერდი.
მომხამერებლების ჩაწერა ხდება MySQL-ის ბაზაში ცხრილში users, 
ავტორიზაციისას მონაცემები - მომხმარებელზე, მოწყობილობაზე და session კოდი ინახება ცალკე ცხრილში -->

<div class="forms">
<!-- <form action="p.php" method="POST"> -->
<form action="actions/session.php" method="POST">
  <label for="enteruser">მომხმარებლის სახელი:</label>
  <input type="text" id="username" name="username" placeholder="მომხმარებელი . . .">

  <label for="device">მოწყობილობა:</label>
  <input type="text" id="device" name="device" placeholder="მოწყობილობის  . . . ">

  <input type="submit" value="შესვლა">
</form>
</div>
<h3 style="color: red;">
<?php
echo '<hr>';
if (isset($_GET['error'])){
  echo "<hr>";
  echo "<hr>";
  echo $_GET['error'];
  }
echo '<hr>';
?>
</h3>
