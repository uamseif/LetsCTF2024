<?php
  if (!isset($_COOKIE['isAdmin'])) {
      setcookie("isAdmin", 0);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarro de Galletas</title>
</head>
<body>
    <h1>Tarro de Galletas de la Abuelita</h1>
    <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExc2V1Y3duN21pOXl5cjA4cTJjdGNmdXdmdzdwdmttbmozamlybmlkeCZlcD12MV9naWZzX3NlYXJjaCZjdD1n/Qu7AOT1vEwdC4xqlxg/giphy.gif">
    <br>
    <br>
    <form action="take_cookie.php" method="post">
        <input type="submit" value="Coger una galleta" name="take_cookie" style="font-size: 20px;">
    </form>
</body>
</html>