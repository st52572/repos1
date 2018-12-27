<div class="item2">

    <div id="registrace">
        <h2>Registrace</h2>
        <form method="post" action="<?php echo htmlspecialchars("controllers/CRegistrace.php"); ?>">
            <div class="row">
                <label>Přihlašovací jméno</label><input required type="text" name="prihlasovaci_jmeno">
            </div>
            <div class="row">
                <label>Heslo</label><input required type="password" name="heslo">
            </div>
            <div class="row">
                <label>Heslo znovu</label><input required type="password" name="heslo2">
            </div>
            <div class="row">
                <label>Jméno</label><input required type="text" name="jmeno">
            </div>
            <div class="row">
                <label>Příjmení</label><input required type="text" name="prijmeni">
            </div>
            <div class="row">
                <label>Email</label><input required type="text" name="email">
            </div>
            <div class="row">
                <label>Telefon</label><input required type="text" name="telefon">
            </div>
            <button type="submit">Registrovat</button>
        </form>
    </div>
</div>
