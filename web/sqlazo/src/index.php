<!DOCTYPE HTML>
<html>
<head>
  <title>Consulta rápida por ID</title>
  <style>
    html {
      font-family: sans-serif;
    }
  </style>
</head>
<body>
  <h1>Consulta rápida por nombre de usuario</h1>
  <p>Introduce un nombre de usuario para ver su email.</p>

  <p>Consultas frecuentes:</p>
  <ul>
    <li>Antonio -> antonio@web.com</li>
    <li>Juan -> juan@web.com</li>
    <li>Pedro -> pedro@web.com</li>
  </ul>
<?php
  $dbfile = __DIR__ . "/database.db";
  $conn = new SQLite3($dbfile);
  if ($conn->connect_error) {
      die("Connection with database failed. Contact CTF administrators: " . $conn->connect_error);
  }
  if (isset($_GET['username'])) {     
      $username = $_GET['username'];
      $escaped_username = htmlspecialchars($username, ENT_QUOTES);
      echo("<form method='GET'> <input type='text' name='username' placeholder='Username' value='$escaped_username' required> <input type='submit' value='Search'> </form><br>"); 

      // Vulnerable SQL query
      $sql = "SELECT * FROM users WHERE username = '$username'";
      $res = $conn->query($sql);

      $rows = 0;
      while ($row = $res->fetchArray()) {
          $rows++;
          echo "Username: " . $row['username'] . "<br>";
          echo "Email: " . $row['email'] . "<br><br>";
      }
      if ($rows == 0) {
          echo "No se han encontrado usuarios con ese nombre";
      }
      $conn->close();
  } else {
    echo("<form method='GET'> <input type='text' name='username' placeholder='Username' required> <input type='submit' value='Search'> </form>"); 
  }
?>