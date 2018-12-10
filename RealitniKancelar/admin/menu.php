<?php

echo "<a href='uzivatele.php'>Uživatelé</a>";
echo "<a href='../index.php'>Hlavní stránka</a>";
if (isset($_SESSION["logged"])) {    
    echo "<a href='controllers/CLogout.php'>Odhlásit</a>";
} else {
    echo "<a href='login.php'>Přihlásit</a>";
}
echo"<a href='javascript:void(0);' class='icon' onclick='myFunction()'>
    <i class='fa fa-bars'></i>
  </a>"
?>