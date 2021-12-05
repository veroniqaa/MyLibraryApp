<?php

require_once("NeoQuery.php");
include('interface/header.php');

if (!(isset($_SESSION['loggedInId'])) && !($_SESSION['loggedInId']==true)) header('Location: login.php');
$userId = $_SESSION['loggedInId'];

echo '<div class="content-header">DODAJ KSIĄŻKĘ</div>
<div id="log_reg_panel"> 
    <div id="register_panel">
        <form method="post" action="formController.php">
            </br></br> <input type="text" id="title" name="title" placeholder="Tytuł"/>
            </br></br> <input type="text" id="author" name="author" placeholder="Autor"/>
            </br></br> <input type="text" id="genre" name="genre" placeholder="Gatunek"/>
            </br></br>
            <input type="submit" name="submitAddBook" class="changePanelButton" value="DODAJ" />
        </form>
    </div>
</div>';

