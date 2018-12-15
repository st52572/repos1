<?php
if (!isset($_SESSION["logged"])) {
    header("Location: index.php");
} else {
    $id = $_SESSION["id"];
}
?>

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
