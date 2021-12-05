
<div id="panel_boczny">
    <div>

<?php
    if (!(isset($_SESSION['loggedInId'])) && !($_SESSION['loggedInId']==true)) {
        header('Location: login.php');
    }
    echo '<a href="myBooks.php"> <div class="panel_boczny_button"><p>MOJA BIBLIOTEKA</p> </div></a>';
    echo '<a href="allBooks.php"> <div class="panel_boczny_button"><p>WSZYSTKIE KSIĄŻKI</p> </div></a>';
    echo '<a href="addBook.php"> <div class="panel_boczny_button"><p>DODAJ KSIĄŻKĘ</p> </div></a>';
    echo '<a href="recommendations.php"> <div class="panel_boczny_button"><p>INNI CZYTALI RÓWNIEŻ</p> </div></a>';
    echo '  <form method="post" action="formController.php">
                <input type="submit" name="submitLogOut" value="WYLOGUJ SIĘ" class="panel_boczny_button"/>
            </form>'; 
?>         

	</div>
</div>