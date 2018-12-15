            <div class="item2">

                <div id="login">
                    <h2>Login</h2>
                    <?php
                    if (isset($_SESSION["logged"])) {
                        echo "<a href='controllers/CLogout.php'>Odhlásit</a>";
                    } else {
                        $login = htmlspecialchars('controllers/CLogin.php');
                        echo "<form method='post' action='$login'>
                            <div class='row'>
                                <label>Přihlašovací jméno</label><input required type='text' name='prihlasovaci_jmeno'>
                            </div>  
                            <div class='row'>  
                                <label>Heslo</label><input required type='password' name='heslo'>
                            </div>  
                                <button type='submit'>Přihlásit</button>
                            </form>";
                    }
                    ?>
                </div>
            </div>

