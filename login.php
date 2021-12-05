<?php

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
    header('Location: index.php');
    exit();
}
include('interface/header.php');
require_once("NeoQuery.php");

echo '
<div id="log_reg_panel"> 
    <div id="buttons">
        <button class="changePanelButton" id="login" onclick="showLoginPanel();">ZALOGUJ SIĘ</button>
        <button class="changePanelButton" id="register" onclick="showRegisterPanel();">ZAREJESTRUJ SIĘ</button>
    </div>
    <div id="login_panel">
        <form method="post" action="formController.php">
            </br></br> <input type="text" id="login" name="login" placeholder="Login"/>
            </br></br> <input type="password" id="password" name="password" placeholder="Hasło"/>
            </br></br>
            <input type="submit" name="submitLogin" class="changePanelButton" value="ZALOGUJ SIĘ" />
        </form>
    </div>
    <div id="register_panel" style="display:none;">
        <form method="post" action="formController.php">
            </br></br> <input type="text" id="name" name="name" placeholder="Imię"/>
            </br></br> <input type="number" id="birth_year" name="birth_year" placeholder="Rok urodzenia"/>
            </br></br> <input type="text" id="login" name="login" placeholder="Login"/>
            </br></br> <input type="password" id="password" name="password" placeholder="Hasło"/>
            </br></br> <input type="password" id="password2" name="password2" placeholder="Powtórz hasło"/>
            </br></br>
            <input type="submit" name="submitRegister" class="changePanelButton" value="ZAREJESTRUJ SIĘ" />
        </form>
    </div>
</div>';

?>

<style>

#content {
    width: 96%;
}

</style>

<script>

function showLoginPanel() {
    document.getElementById("login_panel").style.display = "block";
    document.getElementById("register_panel").style.display = "none";
}

function showRegisterPanel() {
    document.getElementById("login_panel").style.display = "none";
    document.getElementById("register_panel").style.display = "block";

}

</script>