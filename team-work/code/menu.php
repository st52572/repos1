<?php
echo "<a href='index.php'>Hlavní stránka</a>";
echo "<a href='?page=nemovitosti'>Nemovitosti</a>";
if (isset($_SESSION["logged"])) {    
    echo "<a href='?page=moje-nemovitosti'>Moje nemovitosti</a>";
    echo "<a href='?page=nova-nemovitost'>Nová nemovitost</a>";
    echo "<a href='?page=nabidky'>Podané nabídky</a>";
    echo "<a href='?page=moje-nabidky'>Moje nabídky</a>";
    echo "<a href='?page=profil'>Můj profil</a>";
    echo "<a href='controllers/CLogout.php'>Odhlásit</a>";
    if($_SESSION["opravneni"] == 1)
    {
        echo "<a href='admin/uzivatele.php'>Admin</a>";
    }   
} else {
    echo "<a href='?page=login'>Přihlásit</a>";
    echo "<a href='?page=registrace'>Registrace</a>";
}
echo"<a href='javascript:void(0);' class='icon' onclick='myFunction()'>
    <i class='fa fa-bars'></i>
  </a>"
?>