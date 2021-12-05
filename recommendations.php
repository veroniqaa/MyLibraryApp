<?php

require_once("NeoQuery.php");
include('interface/header.php');

if (!(isset($_SESSION['loggedInId'])) && !($_SESSION['loggedInId']==true)) header('Location: login.php');
$userId = $_SESSION['loggedInId'];

$neoQuery = new NeoQuery();
$books = $neoQuery->getAllUserRecommendations($userId);

echo '<div class="content-header">INNI CZYTALI RÓWNIEŻ</div></br>';
foreach($books as $book) {
    echo '<div class="book-container"> <a href="book.php?id='.$book['id'].'">
            <div class="book-container-left">
                <form method="post" action="formController.php">
                    <input type="hidden" name="bookId" value="'.$book['id'].'"/>
                    <input type="submit" class="add-button" name="submitAddBookToLiked" value="+" />
                </form>
            </div>
            <div class="book-container-right">
                <div class="title-span">'.$book['title'].'</div>
                <div class="author-span">'.$book['author'].'</div>
            </div>
            </br></a>
        </div>';
}

include('interface/footer.php');
