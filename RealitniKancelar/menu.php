<?php

echo "<a href='nemovitosti.php'>Nemovitosti</a>";
if (isset($_SESSION["logged"])) {    
    echo "<a href='moje-nemovitosti.php'>Moje nemovitosti</a>";
    echo "<a href='nova-nemovitost.php'>Nová nemovitost</a>";
    echo "<a href='nabidky.php'>Podané nabídky</a>";
    echo "<a href='moje-nabidky.php'>Moje nabídky</a>";
    echo "<a href='profil.php'>Můj profil</a>";
    echo "<a href='controllers/CLogout.php'>Odhlásit</a>";
    if($_SESSION["opravneni"] == 1)
    {
        echo "<a href='admin/uzivatele.php'>Admin</a>";
    }   
} else {
    echo "<a href='login.php'>Přihlásit</a>";
    echo "<a href='registrace.php'>Registrace</a>";
}
echo"<a href='javascript:void(0);' class='icon' onclick='myFunction()'>
    <i class='fa fa-bars'></i>
  </a>"
?>