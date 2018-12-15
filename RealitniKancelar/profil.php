<?php
session_start();
if (!isset($_SESSION["logged"])) {
    header("Location: http://localhost/realitnikancelar/index.php");
} else {
    $id = $_SESSION["id"];
}
?>
<!DOCTYPE html>
<html lang="cs-CZ">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/script.js"></script>
        <title>Profil</title>
    </head>
    <body>
        <div class="item1">
            <?php
            require_once 'info/info.php';
            require_once 'menu.php';
            ?>

        </div>
        <div class="item2">
            
            <?php
            $uzivatel = CUzivatel::selectUzivatel($id);
            $page = htmlspecialchars('controllers/CProfil.php');
            echo "<div id='zmena-udaju'>
                <h2>Profil</h2>
            <form method='post' action='$page'>
            <input type='hidden' name='id' value=$id>
                <div class='uzivatele'>
                <div class='row-uzivatele'>
                    <label>Přihlašovací jméno</label><input required type='text' name='prihlasovaci_jmeno' value='" . $uzivatel->getPrihlasovaci_jmeno() . "'>
                </div>
                <div class='row-uzivatele'>
                <label>Nové heslo</label> <input type='password' name='heslo'>
                </div>
                <div class='row-uzivatele'>
                <label>Nové heslo znovu</label> <input type='password' name='heslo2'>
                </div>
                <div class='row-uzivatele'>
                    <label>Jméno</label>
                    <input required type='text' name='jmeno' value='" . $uzivatel->getJmeno() . "'>
                </div>
                <div class='row-uzivatele'>
                    <label>Příjmení</label>
                    <input required type='text' name='prijmeni' value='" . $uzivatel->getPrijmeni() . "'>
                </div>
                <div class='row-uzivatele'>
                    <label>Email</label>
                    <input required type='text' name='email' value='" . $uzivatel->getEmail() . "'>
                </div>
                <div class='row-uzivatele'>
                    <label>Email</label>
                    <input required type='text' name='telefon' value='" . $uzivatel->getTelefon() . "'>
                </div>
                <div class='row-uzivatele'>
                    <label>Staré heslo</label>
                     <input required type='password' name='sheslo'>
                </div>
            <button type='submit'>Změnit</button>
            </div>
        </form></div>";
            ?>
        </div>
        <?php
        require_once 'footer.php';
        ?>
    </body>
</html>