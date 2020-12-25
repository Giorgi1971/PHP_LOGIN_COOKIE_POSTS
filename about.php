<?php 
include "header.php";

echo "<h2>About!</h2>";


if($auth){?>

<form action='actions/posting.php' method='POST'>
<label for='textm'> პოსტის გამოქვეყნება, ჩაწერეთ ტექსტი: </label>
<input type='text' name='textm' placeholder='Enter text'>
<input type='submit' name='send' value='send'>
</form>

<?php
}

include "footer.php";
