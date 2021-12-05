<?php

require_once("NeoQuery.php");

if (!(isset($_SESSION['loggedInId'])) && !($_SESSION['loggedInId']==true)) header('Location: login.php');

if(!isset($_GET['id'])) header('Location: myBooks.php');

include('interface/header.php');
$userId = $_SESSION['loggedInId'];

$bookId = $_GET['id'];
$neoQuery = new NeoQuery();
$book = $neoQuery->getBook($bookId);

if(count($book)>0) {
    echo '<div id="book-info">
            <p> Tytuł: '.$book[0]['title'].'</p>
            <p> Autor: '.$book[0]['author'].'</p>
            <p>Gatunek: '.$book[0]['genre'].'</p>
        </div>';

    echo '<div class="rec-info">Inni, którzy lubią tą książkę czytali również: </div></br>';
    $books = $neoQuery->getRecommendationsOnBook($userId, $bookId);
    foreach($books as $b) {
        echo '<div class="book-container"> <a href="book.php?id='.$b['id'].'">
            <div class="book-container-left">
                <form method="post" action="formController.php">
                    <input type="hidden" name="bookId" value="'.$b['id'].'"/>
                    <input type="submit" class="add-button" name="submitAddBookToLiked" value="+" />
                </form>
            </div>
            <div class="book-container-right">
                <div class="title-span">'.$b['title'].'</div>
                <div class="author-span">'.$b['author'].'</div>
            </div>
            </br></a>
        </div>';
    }
} else {
    echo '<div class="content-header">Niestety, nie ma takiej książki!</div>';
}

include('interface/footer.php');

