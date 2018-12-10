<?php
session_start();
if (!isset($_SESSION["logged"]) && $_SESSION["opravneni"] != 1) {
    header("Location: http://localhost/realitnikancelar/index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/script.js"></script>
        <title></title>
    </head>
    <body>
        <div class="grid-container">
            <div class="item1" id="myTopnav">
                <?php
                require_once 'info/info.php';
                require_once 'menu.php';
                ?>
            </div>
            <div class="item2">
                <?php
                $select = CUzivatel::selectUzivatele(NULL,"where opravneni > 1");
                $page = htmlspecialchars('controllers/CProfil.php');
                foreach ($select as $uzivatel) {
                    echo "<div id='zmena-udaju'>
                <h2>Profil</h2>
            <form method='post' action='$page'>
            <input type='hidden' name='id' value=" . $uzivatel->getId() . ">
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
                    <label>Jméno</label><input required type='text' name='jmeno' value='" . $uzivatel->getJmeno() . "'>
                    </div>
                    <div class='row-uzivatele'>
                    <label>Příjmení</label><input required type='text' name='prijmeni' value='" . $uzivatel->getPrijmeni() . "'>
                    </div>
                    <div class='row-uzivatele'>
                    <label>Email</label><input required type='text' name='email' value='" . $uzivatel->getEmail() . "'>
                    </div>    
                    <div class='row-uzivatele'>
                    <label>Email</label><input required type='text' name='telefon' value='" . $uzivatel->getTelefon() . "'>
                    </div>   
                    <button type='submit'>Změnit</button>
                </div>        
            
        </form></div>";
                }
                ?>
            </div>
            <?php
            require_once '../footer.php';
            ?>

    </body>

</html>