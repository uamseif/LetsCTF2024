<?php
// Comprobar si el botón se ha pulsado
if (isset($_POST['take_cookie'])) {
    // recuperar la cookie 'isAdmin'
    $isAdmin = isset($_COOKIE['isAdmin']) ? $_COOKIE['isAdmin'] : 0;

    // Verificar si el usuario es un administrador (isAdmin = 1)
    if ($isAdmin == 1) {
        echo "<h1>Aquí tienes tu galleta ;)</h1>";
        echo "<h3 style=\"color:red;\">letsctf{eDiT1NG_c00kiEs_iS_r3Ally_siMPle}</h3>";
        echo "<img src='https://media.giphy.com/media/JrH3p5ZyUHEV6iyvR4/giphy.gif?cid=790b7611ldww88v0eed5314lnfxv0kocva0wp74ls1c195qx&ep=v1_gifs_search&rid=giphy.gif&ct=g'>";
    } else {
        echo "<h1>No puedes coger galletas!!</h1>";
        echo "<img src='https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExbzB1cDBpNm95d2luYm92a2Vjd2xncjVwNzRlajc0dG9jZjhpbXV2eSZlcD12MV9naWZzX3NlYXJjaCZjdD1n/YHSENj45SsL84yK5ud/giphy.gif'>";
        echo "<br><br><button onclick='window.history.back()' style=\"font-size: 20px;\">Volver</button>";
    }
} else {
    // Redirigir a la página principal si se intenta acceder directamente a take_cookie.php
    header("Location: index.php");
    exit();
}
?>
